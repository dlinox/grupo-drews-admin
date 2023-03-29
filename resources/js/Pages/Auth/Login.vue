<template>
    <n-spin :show="show">
        <div class="login-page">
            <div class="img-login"></div>
            <div class="form-login">
                <div class="header">
                    <a href="/">IR A LA WEB</a>
                </div>

                <div class="form-wrapper">
                    <div class="logo">
                        <img :src="$page.props.web.logo" alt="" />
                    </div>
                    <n-form ref="formRef" :model="formData" :rules="rules">
                        <n-form-item path="email" label="Correo">
                            <n-auto-complete
                                v-model:value="formData.email"
                                placeholder="correo"
                                :input-props="{
                                    autocomplete: 'disabled',
                                }"
                                :options="options"
                            >
                                <template #prefix>
                                    <n-icon :component="MailOutline" />
                                </template>
                            </n-auto-complete>
                        </n-form-item>

                        <n-form-item path="password" label="Contraseña">
                            <n-input
                                type="password"
                                show-password-on="click"
                                v-model:value="formData.password"
                                placeholder="Contraseña"
                            >
                                <template #prefix>
                                    <n-icon :component="KeyOutline" />
                                </template>
                            </n-input>
                        </n-form-item>

                        <div class="w-full">
                            <n-button
                                class="w-full"
                                type="primary"
                                @click="submit"
                                :loading="formData.processing"
                            >
                                Ingresar
                            </n-button>
                        </div>
                    </n-form>
                </div>
                <div class="footer-login">
                    © Copyright
                    <a href="https://caripperu.com/" target="_blank">
                        CARIP-PERU.
                    </a>
                    All Rights Reserved
                </div>
            </div>
        </div>
    </n-spin>
</template>
<script setup>
import { ref, computed } from "vue";
import { useForm, router, Link } from "@inertiajs/vue3";
import { MailOutline, KeyOutline } from "@vicons/ionicons5";
import { useToast } from "vue-toastification";
const toast = useToast();

const show = ref(false);
const formRef = ref(null);

const formData = useForm({
    email: "",
    password: "",
});

const rules = {
    email: {
        type: "email",
        required: true,
        message: "Correo no valido",
        trigger: ["input", "blur"],
    },
    password: {
        required: true,
        message: "Obligaorio",
        trigger: ["input", "blur"],
    },
};

const options = computed(() => {
    return [
        "@gmail.com",
        "@outlook.com",
        "@hotmail.com",
        "@grupodrews.com.pe",
    ].map((suffix) => {
        const prefix = formData.email.split("@")[0];
        return {
            label: prefix + suffix,
            value: prefix + suffix,
        };
    });
});

const submit = async () => {
    await formRef.value?.validate(async (errors) => {
        if (!errors) {
            formData.post("auth/sign-in", {
                onError: (e) => {
                    toast.error("Credenciales incorrectas.");
                },
                onSuccess: (e) => {
                    console.log(e);
                    toast.success("Bienvenido ...");
                },
            });
        } else {
            console.log(errors);
            toast.error("Datos ingresado no validos");
        }
    });
};

const withLogin = async () => {
    show.value = true;
    let res = await fetch("/user-auth");
    let json = await res.json();
    if (json) {
        router.get("admin");
    }

    show.value = false;
};
withLogin();
</script>

<style lang="scss">
.login-page {
    display: block;
    width: 100vw;
    height: 100vh;
    background-color: #eeeeee;
    display: flex;
    .header {
        background-color: $app-color1;
        width: 100%;
        padding: 1rem;
        text-align: center;
        a {
            text-decoration: none;
            color: white;
            font-family: $font-teko;
            font-weight: 800;
            letter-spacing: 1px;
        }
    }

    .footer-login {
        display: flex;
        justify-content: center;
        width: 100%;
        background-color: #eeeeee;
        padding: 1rem;
        display: flex;
        a {
            margin: 0 0.5rem;
            color: $app-color1;
        }
    }
}
.login-page .img-login {
    width: 60%;
    height: 100%;
    background-image: url(/assets/image/bg-login-1.jpeg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    transition: width 0.3s ease;
}
.login-page .form-login {
    width: 40%;
    height: 100%;
    background-color: white;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    align-items: center;
    overflow-y: auto;
    overflow-x: hidden;
    transition: width 0.3s ease;
}
.login-page .form-login .form-wrapper {
    max-width: 350px;
    width: 95%;
}
.login-page .form-login .form-wrapper .logo {
    display: flex;
    justify-content: center;
    padding-bottom: 3rem;
    margin: 0 auto;
    width: 200px;
    img {
        width: 100%;
        object-fit: contain;
    }
}

@media (max-width: 1024px) {
    .login-page .img-login {
        width: 50%;
    }
    .login-page .form-login {
        width: 50%;
    }
}

@media (max-width: 880px) {
    .login-page .img-login {
        width: 0;
    }
    .login-page .form-login {
        width: 100%;
    }
}
</style>
