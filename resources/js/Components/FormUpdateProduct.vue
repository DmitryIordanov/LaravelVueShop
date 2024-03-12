<template>
    <form class="formAddProduct" ref="formAddProduct" @submit.prevent="submitHandlers" enctype="multipart/form-data">
        <div><h2 class="text-center">Update product</h2></div>
        <v-text-field
            class="mt-3"
            label="Название товара"
            :error-messages="v$.title.$errors.map(e => e.$message)"
            v-model="state.title"
        ></v-text-field>
        <v-text-field
            class="mt-3"
            label="Цена"
            type="number"
            :error-messages="v$.price.$errors.map(e => e.$message)"
            v-model.number="state.price"
        ></v-text-field>
        <v-autocomplete
            class="mt-3"
            label="Наличие товара"
            :error-messages="v$.availability.$errors.map(e => e.$message)"
            v-model="state.availability"
            :items="['В наличии', 'Нет в наличии']"
        >
        </v-autocomplete>
        <v-autocomplete
            class="mt-3"
            label="Доставка"
            :error-messages="v$.delivery.$errors.map(e => e.$message)"
            v-model="state.delivery"
            :items="['Новая почта', 'Укрпочта', 'Meest']"
        ></v-autocomplete>
        <v-file-input
            class="mt-3"
            label="Изображение товара"
            :error-messages="v$.image.$errors.map(e => e.$message)"
            @change="uploadImage"
        >
        </v-file-input>
        <div class="mt-3">
            <span>Описание товара</span>
            <ckeditor
                :editor="editor"
                v-model="state.content"
                :config="editorConfig"
            >
            </ckeditor>
            <div class="v-input__details" style="padding-inline: 16px">
                <div role="alert" aria-live="polite" id="input-0-messages">
                    <div class="v-messages__message" style="color: red">
                        {{ v$.content.$errors.map(e => e.$message).join() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div style="display: flex; align-items: center">
                <v-btn
                    variant="plain"
                    @click="refreshString"
                >
                    <v-icon icon="$loading"></v-icon>
                </v-btn>
                <div>{{ random.randomString }}</div>
            </div>
            <v-text-field
                style="width: 195px;"
                label="Введите капчу"
                :error-messages="v$.captcha.$errors.map(e => e.$message)"
                v-model="state.captcha"
            >
            </v-text-field>
        </div>
        <v-btn
            class="mt-3"
            variant="outlined"
            type="submit"
        >
            submit
        </v-btn>
    </form>
</template>

<script>
import {required, minLength, maxLength, sameAs} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import {computed, reactive} from "vue";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import ApiStore from '@/Api/index.vue';

export default {
    props: {
        idProduct: null
    },
    setup() {
        // Variable with a randomly generated value for captcha
        const random = reactive({
            randomString: Math.random().toString(36).slice(8)
        });

        // Form value interceptors
        const state = reactive({
            title: null,
            price: null,
            availability: null,
            delivery: null,
            image: null,
            content: '',
            captcha: null
        });

        // Function to update the string when the captcha button is clicked
        const refreshString = () => {
            random.randomString = Math.random().toString(36).slice(8);
        }

        // Form validation via Vuelidate
        const rules = computed(() => {
            return {
                title: {required, minLength: minLength(10), maxLength: maxLength(100)},
                price: {required, minLength: minLength(1), maxLength: maxLength(10)},
                availability: {required},
                delivery: {required},
                image: {required},
                content: {required, minLength: minLength(20), maxLength: maxLength(1000)},
                captcha: {required, sameAs: sameAs(random.randomString)}
            }
        });

        // Variable v$ for useVuelidate values
        const v$ = useVuelidate(rules, state);

        // Returning all the features you need
        return {
            random,
            refreshString,
            state,
            v$
        }
    },
    data() {
        return {
            // Ckeditor value ClassicEditor
            editor: ClassicEditor,
            // Ckeditor config for toolbar
            editorConfig: {
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link']
            },
        };
    },
    methods: {
        // UploadImage function to get the uploaded file
        uploadImage(e) {
            this.state.image = e.target.files[0];
        },
        // SubmitHandler function for validating the result from the form
        async submitHandlers() {
            // result variable to get a Boolean value from the form
            const result = await this.v$.$validate();
            // formdata to get values from the form
            const formdata = new FormData();

            formdata.append("title", this.state.title);
            formdata.append("price", this.state.price);
            formdata.append("availability", this.state.availability);
            formdata.append("delivery", this.state.delivery);
            formdata.append("image", this.state.image);
            formdata.append("content", this.state.content);

            // Checking the value of the result variable
            if (result) {
                // Send data to axios request to be sent to server
                // two arguments product id and product update data are sent
                await ApiStore.methods.UpdateProduct(this.idProduct, formdata);
                // Reset form
                this.$refs.formAddProduct.reset();
            }
        }
    }
}

</script>
<style scoped>
.ck-balloon-panel .ck-powered-by a {
    display: none !important;
}
.formAddProduct {
    max-width: 750px;
    margin-left: auto;
    margin-right: auto;
}
</style>
