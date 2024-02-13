<div id="a-form-inputs">
    <div>

        <!-- Input: Text|Password|Email|Number|Url -->
        <div v-if="type == 'text' || type == 'password' || type == 'email' || type == 'number' || type == 'url' || type == 'date' || type == 'time' || type == 'datetime-local'">
            <label :for="name + '-text-' + inputID" v-if="label">{{label}}</label>
            <input :type="type" :id="name + '-text-' + inputID" @input="onInputChange" @blur="handleBlur" :readonly="readonly ? true : null" :autocomplete="autocomplete && (autocomplete == 'false' || autocomplete == 'off') ? 'new-password' : ''" class="a-form input-text" :class="[errors && errors.length > 0 ? 'validation-error' : '', inputClass ? inputClass : null]" v-model="input" />
        </div>

        <!-- Input: Select  -->
        <div v-if="type == 'select'">
            <label :for="name + '-select-' + inputID" v-if="label">{{label}}</label>
            <div class="a-form input-select-container">
                <select :id="name + '-select-' + inputID" class="input-select" @change="onInputChange" @blur="handleBlur" v-model="input" :data-placeholder-selected="placeholder && (input == placeholder) ? true : null">
                    <option v-if="placeholder" hidden value="" disabled selected>{{placeholder}}</option>
                    <option v-for="(option, key) in options" :key="key" :value="key">{{option}}</option>
                    <optgroup v-for="(group, groupKey) in optionGroups" :key="groupKey" :label="groupKey">
                        <option v-for="(option, key) in group" :key="key" :value="key">{{option}}</option>
                    </optgroup>
                </select>
            </div>
        </div>

        <!-- Input: Checkbox -->
        <div v-if="type == 'checkbox' || type == 'radio'">
            <!-- Single Checkbox -->
            <div class="a-form d-flex" v-if="Object.keys(options).length === 0">
                <label v-if="label && labelPosition == 'before'" :for="name + '-box-' + inputID" class="input-box-label-before">{{label}}</label>
                <div class="a-form-input">
                    <input :type="type" :id="name + '-box-' + inputID" @change="onInputChange" class="input-checkbox" v-model="input">
                    <label class="a-form-input-decorator" :class="[type == 'radio' ? 'input-radio' : null]" :for="name + '-box-' + inputID"></label>
                </div>
                <label v-if="label && labelPosition == 'after'" :for="name + '-box-' + inputID" class="input-box-label-after">{{label}}</label>
            </div>
            <!-- Multiple Checkbox -->
            <div v-else>
                <label :for="name + '-box-' + inputID" v-if="label">{{label}}</label>
                <div class="a-form d-flex" v-for="(option, key) in options" :key="key">
                    <label v-if="label && labelPosition == 'before'" :for="name + '-box-' + key" class="input-box-label-before">{{option}}</label>
                    <div class="a-form-input">
                        <input :type="type" :id="name + '-box-' + key" @change="onInputChange" :value="option" class="input-checkbox" v-model="input">
                        <label class="a-form-input-decorator" :class="[type == 'radio' ? 'input-radio' : null]" :for="name + '-box-' + key"></label>
                    </div>
                    <label v-if="label && labelPosition == 'after'" :for="name + '-box-' + key" class="input-box-label-after">{{option}}</label>
                </div>
            </div>
        </div>

        <!-- Input: File|Image  -->
        <div v-if="type == 'file' || type == 'image'">
            <label :for="name + '-file-' + inputID" v-if="label">{{label}}</label>
            <div class="a-form input-upload-area" :has-files="input && input.length > 0 ? true : null">
                <input type="file" :id="name  + '-file-' + inputID" class="a-form input-file" @change="onFileChange" @mouseenter="isDragHover = true;" @mouseleave="isDragHover = false;" @dragenter="isDragHover = true;" @dragleave="isDragHover = false;" multiple />
                <div v-if="input && input.length == 0" class="a-form input-upload-area-mask" :class="isDragHover ? 'active' : ''" >
                    <i class="far fa-image" v-if="type=='image'"></i>
                    <i class="fas fa-arrow-circle-up" v-if="type == 'file'"></i>
                </div>
                <ul v-if="input && input.length > 0" class="p-0">
                    <li v-for="(file,idx) in input" class="image-list" :key="idx">
                        <div class="file-container d-flex flex-row">
                            <div v-if="type == 'image' && file.hasPreview" class="col-1 p-0">
                                <img :src="file.url" class="image-preview scale-preview-image" />
                            </div>
                            <div v-if="type == 'file' || (type == 'image' && !file.hasPreview)" class="col-1 p-0">
                                <i class="far fa-file" style="font-size: 20px;"></i>
                            </div>
                            <div class="col d-flex justify-content-center align-items-center selected-file-name">
                                {{file.name}}
                            </div>
                            <div class="col-1 p-0 d-flex justify-content-end align-items-center">
                                <div class="a-form file-remove" @click="() => onFileRemove(idx)">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div v-if="multiple && input && input.length > 0">
                    <div role="button" class="mb-2 btn btn-outline-primary btn-block d-flex justify-content-center align-items-center">
                        <span v-if="type == 'file'" class="position-absolute">+ Add File</span>
                        <span v-if="type == 'image'" class="position-absolute">+ Add Image</span>
                        <input type="file" multiple="multiple" class="a-form second-input-file" @change="onFileChange" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Input: group -->
        <div v-if="type == 'group'" class="a-form">
            <div :class="repeatable ? 'group-container-repeatable' : ''">
                <div v-for="(group, index) in groupInputs" :key="index + inputID" :class="repeatable ? 'group-item-repeatable' : ''" v-if="updateGroup">
                    <event-listener 
                        @change="(e) => onGroupHandleChange(e, index)"
                        @validate="(e) => onGroupHandleValidation(e, index)"
                        @context="(e) => onGroupHandleContext(e, index)"
                        :values="group"
                    >
                        <div>
                            <a v-if="repeatable" role="button" class="group-item-remove" href="javascript:void(0)" @click="() => onRemoveGroupInput(index)">Remove</a>
                            <slot></slot>
                        </div>
                    </event-listener>
                </div>
            </div>
            <div v-if="repeatable" class="group-item-add">
                <button type="button" @click="onAddGroupInput" class="btn btn-primary btn-outline-primary">{{addLabel}}</button>
            </div>
        </div>

        <!-- Input: Multiselect -->
        <div v-if="type == 'multiselect'" class="a-form">
            <label :for="name + '-select-' + inputID" v-if="label">{{label}}</label>
            <Multiselect
                ref="multiselect"
                v-model="input"
                v-bind="multiSelect"
                class="multi-select"
                @change="onInputChange"
                @close="handleBlur"
                :options="options"
                @search-change="onSearchChange"
            ></Multiselect>
        </div>

        <!-- Input: Textarea -->
        <div v-if="type == 'textarea'">
            <label :for="name + '-textarea-' + inputID" v-if="label">{{label}}</label>
            <textarea v-model="input" class="a-form input-text" @input="onInputChange" @blur="handleBlur" :class="[errors && errors.length > 0 ? 'validation-error' : '', inputClass ? inputClass : null]"></textarea>
        </div>

        <!-- Common -->
        <small v-if="help" :id="name + 'help-text'" class="form-text text-muted" v-if="type != 'group'">
            {{help}}
        </small>
        <div v-for="(error, idx) in errors" class="a-form input-error" v-if="type != 'group'">
            {{error}}
        </div>

        <!-- Input: Submit -->
        <div v-if="type == 'submit'">
            <div>
                <button :type="type" :disabled="loading ? true : false" class="btn btn-primary btn-block">{{loading ? 'Loading Please wait...' : label}}</button>
            </div>
        </div>
    </div>
</div>