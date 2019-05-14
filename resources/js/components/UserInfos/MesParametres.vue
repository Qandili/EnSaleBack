<template>
<b-container fluid>
    <b-row>
        <b-col class="m-auto" cols="6">
            <b-img  circle center src="https://picsum.photos/125/125/?image=58" alt="Center image" class="profileImage"></b-img>
        </b-col>
    </b-row>
    <b-row>
        <b-col cols="6" class="m-auto m-0">
            <b-form  @submit="onSubmit" @reset="onReset" v-if="show">
                    <b-form-group
                    id="input-group-1"
                    label="Email address:"
                    label-for="input-1"
                    description="We'll never share your email with anyone else.">
                        <b-form-input
                            id="input-1"
                            v-model="form.email"
                            type="email"
                            placeholder="Enter email"
                            >
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="input-group-2" label="Your firstName:" label-for="input-2">
                        <b-form-input
                        id="input-2"
                        v-model="form.firstName"
                        placeholder="Enter firstName"
                        >
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-2" label="Your firstName:" label-for="input-2">
                        <b-form-input
                        id="input-2"
                        v-model="form.lastName"
                        placeholder="Enter lastName"
                        >
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-2" label="Your cne:" label-for="input-2">
                        <b-form-input
                        id="input-2"
                        v-model="form.cne" disabled
                        placeholder="Enter firstName"
                        >
                        </b-form-input>
                    </b-form-group>
                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
        </b-col>
        </b-row>

</b-container>
</template>

<script>
export default {
    data() {
    return {
        form: {
        cne:this.$parent.user.student_cne,
        email: this.$parent.user.email,
        firstName: this.$parent.user.first_name,
        lastName:this.$parent.user.last_name,
        },
        foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
        show: true
    }
    },
    methods: {
    onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
    },
    onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.firstName = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
        this.show = true
        })
    }
    }
}
</script>