<script context="module">
    export { default as layout } from "../Layouts/Auth.svelte";
</script>

<script>
    import { useForm, Link } from "@inertiajs/svelte";
    import { Input, Spinner } from "@sveltestrap/sveltestrap";

    let form = useForm({
        email: "",
        password: "",
    });

    function submit() {
        $form.post("/login", {
            onSubmit: () => $form.reset("password"),
        });
    }
</script>

<svelte:head>
    <title>Log In</title>
</svelte:head>

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="assets/img/login.png" alt="Logo"/>
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Welcome to Preskool</h1>
                        <p class="account-subtitle">
                            Need an account? <Link href={route("register")}>Sign Up</Link>
                        </p>
                        <h2>Sign in</h2>

                        <form action={route('login')} on:submit|preventDefault={submit}>
                            <div class="form-group">
                                <label>Username <span class="login-danger">*</span></label>
                                <Input type="text" bind:value={$form.email} invalid={$form.errors.email} feedback={$form.errors.email} />
                            </div>
                            <div class="form-group">
                                <label>Password <span class="login-danger">*</span></label>
                                <Input class="form-control pass-input" type="password" bind:value={$form.password} valid={!!$form.errors.password} feedback={$form.errors.password}/>
                            </div>
                            <div class="forgotpass">
                                <div class="remember-me">
                                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
                                        Remember me
                                        <input type="checkbox" name="radio" />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <Link href={route("password.request")}>Forgot Password?</Link>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Login
                                    {#if $form.processing}
                                        <Spinner type="border" size='sm' />
                                    {/if}
                                </button>
                            </div>
                        </form>

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>

                        <div class="social-login">
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
