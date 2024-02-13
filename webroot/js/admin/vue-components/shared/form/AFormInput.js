
app.component('a-form-input', {
    props: {
        name: {
            type: String,
            default: 'input'
        },
        readonly: {
            default: false
        },
        type: {
            type: String,
            default: 'text'
        },
        options: {
            default: {}
        },
        optionGroups: {
            type: Object || Array,
            default: {}
        },
        placeholder: String,
        label: String,
        labelPosition: {
            type: String,
            default: 'after'
        },
        help: String,
        autocomplete: String,
        validation: {
            type: String,
            default: ''
        },
        validationName: {
            type: String,
            default: null
        },
        multiple: {
            type: Boolean,
            default: false
        },
        // MultiSelect
        multiSelect: {
            type: Object,
            default: {}
        },
        //Button Submit
        loading: {
            type: Boolean,
            default: false
        },
        inputClass: {
            default: null
        },
        // Repeatable
        repeatable: {
            type: Boolean,
            default: false
        },
        addLabel: {
            type: String,
            default: 'Add'
        },
        // \ Repeatable Ends
        modelValue: String || Object || Boolean || Number //v-model
    },
    emits: ['update:modelValue', 'change', 'context', 'remove'], //change & context is defined for group inputs
    template: document.getElementById('a-form-inputs').innerHTML,
    data() {
        return {
            input: this.modelValue || _.get(this.$parent,'values[' + this.name + ']', null), //this.type !== 'group' ?  : null
            groupInputs: this.type === 'group' && _.get(this.$parent,'values[' + this.name + '].length', 0) > 0 ?  _.get(this.$parent,'values[' + this.name + ']', [{}]) : [{}], //group Fields
            errors: _.get(this.$parent,'errors[' + this.name + ']', []) || [],
            isDragHover: false,
            inputID: Math.round(Math.random() * 100).toString(),
            updateGroup: true
        }
    },
    methods: {
        onFileChange(e) {
            const files = e.target.files;
            this.isDragHover = false;
            _.map(files, (file, idx) => {
                if (!this.multiple && idx === 0) {
                    this.input.push({ file, name: file.name, url: URL.createObjectURL(file), type: file.type, hasPreview: file.type.indexOf('image') > -1 ? true : false });
                } else if (this.multiple) {
                    this.input.push({ file, name: file.name, url: URL.createObjectURL(file), type: file.type, hasPreview: file.type.indexOf('image') > -1 ? true : false });
                }
            });
            const tmpFiles = [];
            this.input.map((val) => tmpFiles.push(val.file));
            this.$parent.$emit('change', { name: this.name, value: tmpFiles });
            this.onValidation();
        },
        onFileRemove(idx) {
            const tmpFiles = [];
            this.input.map((val) => tmpFiles.push(val.file));
            this.$emit('remove', this.input[idx]);
            this.input.splice(idx, 1);
            this.$parent.$emit('change', { name: this.name, value: tmpFiles });
            this.onValidation();
        },
        onInputChange(e) {
            if (this.type == 'checkbox') {
                this.$parent.$emit('change', { name: this.name, value: this.input });
                this.$emit('update:modelValue', this.input);
            } else if (this.type == 'multiselect') {
                this.$parent.$emit('change', { name: this.name, value: e });
                this.$emit('update:modelValue', e);
            } else {
                this.$parent.$emit('change', { name: this.name, value: e.target.value });
                this.$emit('update:modelValue', e.target.value);
            }
        },
        handleBlur(e) {
            this.$parent.$emit('blur', { name: this.name, value: true });
            this.onValidation();
        },
        onValidation() {
            const rules = this.validation ? _.uniq(this.validation.split('|')) : [];
            this.errors = [];
            rules.map((rule) => {//if we want to break the rule loop use `some` and return true
                const newRule = rule ? rule.split(':') : [];
                switch(_.get(newRule, '[0]', rule)) {
                    case 'required': this.isRequired(); break;
                    case 'email': this.isEmail(); break;
                    case 'number': this.isNumber(); break;
                    case 'min': this.isMin(newRule[1]); break;
                    case 'max': this.isMax(newRule[1]); break;
                    case 'between': this.isBetween(newRule[1]); break;
                    case 'url': this.isUrl(); break;
                    case 'mime': this.hasMime(newRule[1]); break;
                }
            });
            //Send error to parent
            this.$parent.$emit('validate', { name: this.name, errors: this.errors });
            return true;
        },
        // Rules Function
        //---------------------
        isRequired() {
            if (!this.input) {
                this.errors.push((this.validationName || this.name) + ' is required.');
            }
            if (Array.isArray(this.input) && this.input.length === 0) {
                this.errors.push((this.validationName || this.name) + ' is required.');
            }
            return true;
        },
        isEmail() {
            const regEx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!this.input) {
                this.errors.push('Please enter a valid email address.');
            } else if (!regEx.test(this.input)) {
                this.errors.push('"' + this.input + '" is not a valid email address.');
            }
            return true;
        },
        isNumber() {
            if (isNaN(this.input)) {
                this.errors.push((this.validationName || this.name) +' must be a number.');
            }
            return true;
        },
        isMin(val) {//2 types available - value & length
            const tmpVal = val ? val.split(',') : [];
            const num = _.get(tmpVal,'[0]', 1); //Number
            let type = _.get(tmpVal,'[1]', 'length').toLowerCase();
            
            if (type == 'length') {
                if (_.get(this.input, 'length', 0) < num) {
                    if (Array.isArray(this.input)) {
                        this.errors.push('You need to at least select ' + num + ' ' + (this.validationName || this.name));
                    } else {
                        this.errors.push((this.validationName || this.name) + ' must be at least ' + num + ' characters long.');
                    }
                }
            } else if (type == 'value') {
                if (parseFloat(this.input) < num) {
                    this.errors.push((this.validationName || this.name) + ' must be at least ' + num + '.');
                }
            }
            return true;
        },
        isMax(val) {//2 types available - value & length
            const tmpVal = val ? val.split(',') : [];
            const num = _.get(tmpVal,'[0]', 1); //Number
            let type = _.get(tmpVal,'[1]', 'length').toLowerCase();

            if (type == 'length') {
                if (_.get(this.input, 'length', 0) > num) {
                    if (Array.isArray(this.input)) {
                        this.errors.push('You can maximum select ' + num + ' ' + (this.validationName || this.name));
                        // You can maximum select 2 documents
                    } else {
                        this.errors.push((this.validationName || this.name) + ' must be less than or equal to ' + num + ' characters long.');
                    }
                }
            } else if (type == 'value') {
                if (parseFloat(this.input) > num) {
                    this.errors.push((this.validationName || this.name) + ' must be less than or equal to ' + num + '.');
                }
            }
            return true;
        },
        isBetween(val) {
            const tmpVal = val ? val.split(',') : [];
            const num1 = _.get(tmpVal,'[0]', 1); //Number 1
            const num2 = _.get(tmpVal,'[1]', 1); //Number 2
            let type = _.get(tmpVal,'[2]', 'length').toLowerCase();

            if (type == 'length') {
                if (_.get(this.input, 'length', 0) < num1 || _.get(this.input, 'length', 0) > num2) {
                    if (Array.isArray(this.input)) {
                        this.errors.push('You need at least ' + num1 + ' to ' + num2 + ' ' + (this.validationName || this.name));
                        //You need at least 2 to 3 documents.
                    } else {
                        this.errors.push((this.validationName || this.name) + ' must be between ' + num1 +' to ' + num2 + ' characters long.');
                    }
                }
            } else if (type == 'value') {
                if (parseFloat(this.input) < num1 || parseFloat(this.input) > num2) {
                    this.errors.push((this.validationName || this.name) + ' must be between ' + num1 +' to ' + num2 + '.');
                }
            }
            return true;
        },
        isUrl() {
            const regEx = /^(((ftp|http|https):\/\/)|(\/)|(..\/))(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/;
            if (!regEx.test(this.input)) {
                this.errors.push('Please include a valid url.');
            }
            return true;
        },
        hasMime(val) {
            const tmpVal = val ? val.split(',') : []; //mime types
            let hasErrors = false;
            this.input.map((file) => {
                const mimeIdx = tmpVal.indexOf(file.type);
                if (mimeIdx === -1) {
                    hasErrors = true;
                }
            });
            if (hasErrors) {
                this.errors.push((this.validationName || this.name) + ' must be of the type: ' + val);
            }
            return true;
        },
        // \ Rules Functions Ends here.....
        //---------------------------

        // Group Fields Handled
        //----------
        onGroupHandleChange({ name, value }, idx) {
            // console.log("Field Changed: ", this.name, name, value, idx);
            // console.log("Index: ", idx);
            _.set(this.input, '[' + idx + ']['+ name +']', value);
            let tmpGroupInputs = _.cloneDeep(this.groupInputs);
            _.set(tmpGroupInputs, '[' + idx + ']['+ name + ']', value);
            this.groupInputs = tmpGroupInputs;
            // console.log("Name: ", this.name, this.input)
            this.$parent.$emit('change', { name: this.name, value: this.groupInputs });
            // console.log("Input: ", this.input);
        },
        onGroupHandleValidation({ name, errors }, idx) {
            // console.log("[Group] Validation ", this.name, name, errors, idx);
            _.set(this.errors, '[' + idx + ']['+ name +']', errors);
            //Send group errors to parent
            this.$parent.$emit('validate', { name: this.name + '.' + idx + '.' + name, errors: errors });
        },
        onGroupHandleContext(ctx, idx) {
            // console.log("Context: ", ctx);
            this.$parent.$emit('context', ctx);
        },
        onAddGroupInput() {
            this.groupInputs.push({});
        },
        onRemoveGroupInput(idx) {
            // console.log("Index: ", idx);
            this.updateGroup = false;

            this.groupInputs.splice(idx, 1);
            setTimeout(() => {
                // console.log("GroupInputs: ", this.groupInputs, this.input);
                this.updateGroup = true;
            }, 2)
            this.$parent.$emit('change', { name: this.name, value: this.groupInputs });
        },
        // \ Group Field Ends...
        //------------------------

        // MultiSelect Functions
        onSearchChange: _.debounce(
            async function(query) {
                if (typeof this.options == 'function') {
                    await this.options(query);
                    this.$refs.multiselect.refreshOptions();
                }
            }, 300
        )
    },
    mounted() {
        if (this.type !== 'group') {
            this.$parent.$emit('context', this);
        }
        // if (this.type == 'group') {
            // this.$parent.$emit('change', { name: this.name, value: this.groupInputs });
            // console.log("Values; ", this.$parent.values);
            // this.groupInputs = this.$parent.values[this.name];
            // console.log("GroupInputs: ", this.groupInputs);
        // }
        if (this.type == 'file' || this.type == 'image' || this.type == 'group') {
            if (!_.get(this.$parent,'values[' + this.name + ']', null)) {
                this.input = [];
            }
        } else if (this.type == 'text' || this.type == 'password' || this.type == 'email' || this.type == 'number' || this.type == 'url' || this.type == 'date' || this.type == 'time' || this.type == 'datetime-local') { //syncing each input v-model values with parent
            this.$parent.$emit('change', { name: this.name, value: this.input });
        } else if (this.type == 'select') {
            this.placeholder && !this.input ? this.input = '' : null; 
        } else if (this.type == 'checkbox' || this.type == 'radio') {
            if (Object.keys(this.options).length > 0 && !_.get(this.$parent,'values[' + this.name + ']', null)) {
                this.input = [];
            }
        }
    },
    beforeUnmount() {
        console.log("Name: ", this.name, " is going to unmount.");
        if (this.type !== 'group') {
            this.$parent.$emit('remove-element', this.name);
        }
    }
});