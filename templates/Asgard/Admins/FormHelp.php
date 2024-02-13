<a-form 
    :values="{
        name: 'test',
        password: '12345678',
        email: 'sufyan@ascendtis.com',
        age: 19,
        website: 'http://ascendtis.com',
        media_id: [
            {
                url: 'https://via.placeholder.com/150x150',
                name: 'employment-offer.jpg',
                hasPreview: true
            }
        ],
        pets: ['Cats','Dogs'],
        pet: 'Cat'
    }"
    v-model="formValues"
    @submit="(values) => onSubmit(values)"
>
    <h1>Sample Forms</h1>
    <a-form-input
        type="text"
        name="name"
        label="Name"
        help="John Doe"
        validation="required"
    ></a-form-input>

    <a-form-input
        type="email"
        name="email"
        label="Email address"
        validation="email"
    ></a-form-input>

    <a-form-input
        type="text"
        name="age"
        label="How old are you?"
        validation="required|number|between:8,20,value"
        validation-name="Age"
    ></a-form-input>

    <a-form-input
        type="password" 
        name="password"
        label="Password"
        validation="required|between:8,15"
        autocomplete="false"
    ></a-form-input>

    <a-form-input
        type="url"
        name="website"
        label="Website address"
        validation="url"
    >
    </a-form-input>

    <a-form-input
        type="image"
        name="media_id"
        label="Select your documents to upload"
        help="Select one or more PDFs to upload"
        validation="required|mime:image/jpeg,image/png|min:2"
        validation-name="Images"
        multiple
    ></a-form-input>

    <div class="row">
        <div class="col">
            <a-form-input
                type="group"
                name="address"
                repeatable
                add-label="+ Add Address"
            >
                <div class="row m-0">
                    <div class="col pl-0">
                        <div>
                            <a-form-input
                                label="City"
                                type="text"
                                name="city"
                                validation="required"
                            >
                            </a-form-input>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div>
                            <a-form-input
                                label="Pincode"
                                type="text"
                                name="pincode"
                                validation="required"
                            >
                            </a-form-input>
                        </div>
                    </div>
                </div>
            </a-form-input>
        </div>
    </div>

    <div class="row pt-3">
        <div class="col">
            <a-form-input
                name="gender"
                label="Please select your gender"
                placeholder="Select an option"
                type="select"
                :options="{Male: 'Male', Female: 'Female', Other: 'Other'}"
                :option-groups="{
                    Morning: {
                        10: '10am',
                        11: '11am'
                    },
                    Afternoon: {
                        15: '3pm',
                        17: '5pm'
                    }
                }"

            >
            </a-form-input>
        </div>
        <div class="col">
            <a-form-input
                name="terms"
                type="checkbox"
                label="Do you agree terms?"
                label-position="after"
            ></a-form-input>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a-form-input
                name="country"
                type="multiselect"
                label="Country Selection"
                :multi-select="{
                    searchable: true
                }"
                :options="{
                    india: 'India',
                    usa: 'United Sates of America',
                    russia: 'Russia',
                    brazil: 'Brazil',
                    canada: 'Canada'
                }"
                validation="required"
            >
            </a-form-input>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a-form-input
                type="multiselect"
                name="admin"
                label="Select admin"
                :multi-select="{
                    minChars: 5,
                    searchable: true,
                    mode: 'multiple'
                }"
                :options="async (query) => {
                    return await fetchAdmins(query)
                }"
            >
            </a-form-input>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a-form-input
                type="checkbox"
                name="pets"
                label="Which animals make good pets?"
                :options="{dog: 'Dogs', alligators: 'Alligators', cat: 'Cats'}"
                validation="required|min:2"
            ></a-form-input>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a-form-input
                type="radio"
                name="pet"
                label="Which animals make good pets?"
                :options="{dog: 'Dog', alligators: 'Alligator', cat: 'Cat'}"
                validation="required"
            ></a-form-input>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col">
            <a-form-input 
                type="submit"
                label="Submit"
            >
            </a-form-input>
        </div>
    </div>
</a-form>
<br/>
Form Values: <br/>
{{formValues}}