<template>
    <TransitionGroup name="form">
        <form @submit.prevent="submitHandler" v-if="show">
            <div><h2 class="text-center">Add product</h2></div>
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
            <v-file-input
                class="mt-3"
                label="Изображение товара"
                :error-messages="v$.image.$errors.map(e => e.$message)"
                v-model="state.image"
            >
            </v-file-input>
            <div>
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
                    style="width: 200px;"
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
    </TransitionGroup>
</template>

<script>
import {required, minLength, maxLength, sameAs} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import {computed, reactive} from "vue";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    props: {
        show: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        const random = reactive({
            randomString: Math.random().toString(36).slice(8)
        });

        const state = reactive({
            title: null,
            price: null,
            image: null,
            content: '',
            captcha: null
        });

        const refreshString = () => {
            random.randomString = Math.random().toString(36).slice(8);
        }

        const rules = computed(() => {
            return {
                title: {required, minLength: minLength(10), maxLength: maxLength(100)},
                price: {required, minLength: minLength(1), maxLength: maxLength(10)},
                image: {required},
                content: {required, minLength: minLength(20), maxLength: maxLength(1000)},
                captcha: {required, sameAs: sameAs(random.randomString)}
            }
        });

        const v$ = useVuelidate(rules, state);

        return {
            random,
            refreshString,
            state,
            v$
        }
    },
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link']
            }
        };
    },
    methods: {
        async submitHandler() {
            const result = await this.v$.$validate();
            if (result) {
                console.log(this.state);
            }
        }
    }
}

</script>

<style>
.ck-editor {
    margin-top: 15px !important;
}
.ck-balloon-panel .ck-powered-by a {
    display: none !important;
}
.form-move,
.form-enter-active,
.form-leave-active {
    transition: all 1s ease;
}
.form-enter-from,
.form-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}
</style>
