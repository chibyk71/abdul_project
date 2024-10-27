<script context="module">
    export { default as layout} from '../Layouts/Auth.svelte'
</script>

<script>
    import { FormGroup, Input, Spinner } from '@sveltestrap/sveltestrap';
    import { IconBrandFacebook, IconBrandGoogle, IconBrandTwitter } from "@tabler/icons-svelte";
    import { Link, useForm } from "@inertiajs/svelte";

    const form = useForm({
        name: "",
        email: "",
        username: '',
        password: "",
        password_confirmation: "",
    });

    const handleSubmit = () => {
        $form.post(route("register"), {
            onFinish: () => $form.reset("password", "password_confirmation"),
        });
    };
</script>

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="assets/img/login.png" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Sign Up</h1>
                        <p class="account-subtitle">Enter details to create your account</p>

                        <form action={route('register')} on:submit|preventDefault={handleSubmit}>
                            <FormGroup class="form-group" label='Full Name'>
                                <Input type="text" bind:value={$form.name} valid={!!$form.errors.name} feedback={$form.errors.name} />
                            </FormGroup>

                            <FormGroup class="form-group" label='UserName'>
                                <Input type="text" bind:value={$form.username} valid={!!$form.errors.username} feedback={$form.errors.username} />
                            </FormGroup>

                            <FormGroup class="form-group" label='Email'>
                                <Input type="email" bind:value={$form.email} valid={!!$form.errors.email} feedback={$form.errors.email} />
                            </FormGroup>

                            <FormGroup class="form-group" label='password'>
                                <Input type="password" bind:value={$form.password} valid={!!$form.errors.password} feedback={$form.errors.password} />
                            </FormGroup>

                            <FormGroup class="form-group" label='Confirm Password'>
                                <Input type="password" bind:value={$form.password_confirmation} valid={!!$form.errors.password_confirmation} feedback={$form.errors.password_confirmation} />
                            </FormGroup>

                            <div class=" dont-have">Already Registered? <Link href={route('login')}>Login</Link></div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block"  type="submit">
                                    {#if $form.processing}
                                        <Spinner size='sm' type="border" />
                                    {/if}
                                    Register
                                </button>
                            </div>
                        </form>

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>

                        <div class="social-login">
                            <a href="#"><IconBrandFacebook class='inline-block' /></a>
                            <a href="#"><IconBrandGoogle class='inline-block' /></a>
                            <a href="#"><IconBrandTwitter class='inline-block' /></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>