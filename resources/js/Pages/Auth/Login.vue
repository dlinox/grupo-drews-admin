<template>
     <n-spin :show="show">
    <div class="login-page">
        <div class="img-login"></div>
        <div class="form-login">
            <div>
                <a href="#" class="py-1">IR A LA WEB</a>
            </div>

            <div class="form-wrapper">
                <div class="logo">
                    <img src="/assets/image/logo.png" alt="" />
                </div>
                <n-form ref="formRef" :model="formData">
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

            <small class="py-1"
                >© Copyright GrupoDrews . All Rights Reserved</small
            >
        </div>
    </div>
</n-spin>
</template>
<script setup>
import { ref, computed } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { MailOutline, KeyOutline } from "@vicons/ionicons5";


const  show = ref(false);
const formRef = ref(null);

const formData = useForm({
    email: "",
    password: "",
});



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

const submit = () => {
    formData.post("auth/sign-in");
};

const withLogin = async () => {
    show.value = true;
    let res = await fetch("/user-auth");
    let json = await res.json();
    if(json){
        router.get('admin');
    }

    show.value = false;

};
 withLogin();
</script>

<style lang="css">
.login-page {
    display: block;
    width: 100vw;
    height: 100vh;
    background-color: #eeeeee;
    display: flex;
}
.login-page .img-login {
    width: 60%;
    height: 100%;
    background-image: url(/assets/image/bg-login.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
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
}
.login-page .form-login .form-wrapper {
    max-width: 350px;
    width: 95%;
}
.login-page .form-login .form-wrapper .logo {
    display: flex;
    justify-content: center;
    padding-bottom: 1rem;
}
</style>
