<script context="module">
    export { default as layout } from "../Layouts/Auth.svelte";
</script>

<script>
    // your script goes here
</script>

<svelte:head>
    <title>Reset Password</title>
</svelte:head>
<!-- markup (zero or more items) goes here -->

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="assets/img/login.png" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Resset Password</h1>
                        <p class="account-subtitle">Enter details to create your account</p>

                        <form action="login.html">
                            <FormGroup label='Email'>
                                <Input type="email" />
                            </FormGroup>

                            <FormGroup label='password'>
                                <Input type="password" />
                            </FormGroup>

                            <FormGroup label='Confirm Password'>
                                <Input type="password" />
                            </FormGroup>

                            <div class=" dont-have">Back to Login <a href="login.html">Login</a></div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>