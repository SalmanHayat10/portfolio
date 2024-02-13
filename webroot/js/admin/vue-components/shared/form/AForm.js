app.component('event-listener', {
    emits: ['change', 'blur', 'validate', 'context', 'remove-element'],
    props: {
        values: Object,
        errors: Object
    },
    render() {
        return this.$slots.default ? this.$slots.default() : null;
    },
    mounted() {}
});

app.component('a-form', {
    props: {
        values: {
            type: Object,
            default: {}
        },
        name: {
            type: String,
            default: 'a-form'
        },
        loading: {
            type: Boolean,
            default: false
        },
        modelValue: Object //v-model prop
    },
    emits: ['submit', 'update:modelValue'],
    template: `
        <event-listener 
            @change="handleChange" 
            @blur="handleBlur" 
            @validate="handleValidation"
            @remove-element="handleRemove"
            @context="handleContext"
            :values="values" 
            :errors="errors"
        >
            <div v-if="!loading">
                <form :name="name" @submit="handleSubmit">
                    <slot></slot>
                </form>
            </div>
            <div v-else class="h-25 d-flex justify-content-center align-items-center">
                <div class="loading-spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </event-listener>
    `,
    data() {
        return {
            formData: {
                ...this.values
            },
            errors: {},
            inputContexts: []
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            this.onValidation();
            let hasErrors = false;
            _.map(this.errors, (error, key) => {
                if (_.get(error, 'length', 0) > 0) {
                    hasErrors = true;
                }
                // console.log("Key: ",  key);
            });
            // console.log("Form: ", this.formData);
            // console.log("hasErrors: ",this.errors);
            if (!hasErrors) {
                this.$emit('submit', this.formData);
            }
            // console.log("Form Submit: ", e);
        },
        onValidation() {
            if (_.get(this.inputContexts, 'length', 0) > 0) {
                this.inputContexts.map((ctx) => ctx.onValidation());
            }
        },
        handleContext(ctx) {
            if (ctx) {
                this.inputContexts.push(ctx);
            }
        },
        handleBlur({ name, value }) {
            // console.log("Blur Event: ", name, value);
        },
        handleChange({ name, value }) {
            this.formData[name] = value;
            this.$emit('update:modelValue', this.formData);
        },
        handleValidation({ name, errors }) {
            // console.log("?????", this.errors);
            // console.log("Field: ", name, errors);
            this.errors[name] = errors;
            console.log("Validation Handled: ", name, errors);
        },
        handleRemove(name) {
            //remove this name element.
            this.errors[name] = []; //clear errors
            this.inputContexts = this.inputContexts.filter((ctx) => ctx.name != name); //remove it's context from error.
        }
    },
    mounted() {
        console.log("A Form Loaded.", this.values);
    }
});