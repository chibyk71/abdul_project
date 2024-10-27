<script context="module">
    export {default as layout} from '../Layouts/App.svelte'
</script>

<script>
    import { Input, Spinner } from "@sveltestrap/sveltestrap";
    import { useForm } from "@inertiajs/svelte";

    export let student = {}, edit;
    const form = useForm({
        l_name: student.l_name,
        f_name: student.f_name,
        email: student.email,
        phone: student.phone,
        gender: student.gender,
        religion: student.religion,
        olevel: student.olevel,
        dob: student.dob,
        level: student.level
    })

    const submit = async function () {
        $form.post(edit ? route('student.update', student.id): route('student.store'), {
            onFinish: (param)=>{
                //TODO do something here
            }
        })
    }
</script>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Add Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                        <li class="breadcrumb-item active">Add Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card comman-shadow">
                <div class="card-body">
                    <form on:submit={submit} action={route('student.store')}>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title student-info">Student Information</h5>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>First Name <span class="login-danger">*</span></label>
                                    <Input type="text" placeholder="Enter First Name" bind:value={$form.f_name} invalid={$form.errors.f_name} feedback={$form.errors.f_name} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Last Name <span class="login-danger">*</span></label>
                                    <Input bind:value={$form.l_name} invalid={$form.errors.l_name} feedback={$form.errors.l_name} type="text" placeholder="Enter First Name" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Gender <span class="login-danger">*</span></label>
                                    <Input type='select' bind:value={$form.gender} invalid={$form.errors.gender} feedback={$form.errors.gender}>
                                        <option disabled>Select Gender</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                        <option>Others</option>
                                    </Input>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                    <Input bind:value={$form.dob} invalid={$form.errors.dob} feedback={$form.errors.dob} type="date"
                                    placeholder="date placeholder" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>O, Level </label>
                                    <Input bind:value={$form.olevel} invalid={$form.errors.olevel} feedback={$form.errors.olevel} type="text" placeholder="Enter Roll Number" />
                                </div>
                            </div>
                           
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Religion <span class="login-danger">*</span></label>
                                    <Input bind:value={$form.religion} invalid={$form.errors.religion} feedback={$form.errors.religion} type='select'>
                                        <option disabled>Please Select Religion </option>
                                        <option selected>Hindu</option>
                                        <option>Christian</option>
                                        <option>Others</option>
                                    </Input>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>E-Mail <span class="login-danger">*</span></label>
                                    <Input bind:value={$form.email} invalid={$form.errors.email} feedback={$form.errors.email} type="text" placeholder="Enter Email Address" />
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Phone </label>
                                    <Input bind:value={$form.phone} invalid={$form.errors.phone} feedback={$form.errors.phone} type="phone" placeholder="Enter Phone Number"/>
                                </div>
                            </div>

                            {#if edit}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Level </label>
                                        <Input bind:value={$form.level} invalid={$form.errors.level} feedback={$form.errors.level} type="text" placeholder="Enter Level Number"/>
                                    </div>
                                </div>
                            {/if}

                            <div class="col-12 col-sm-4">
                                <div class="form-group students-up-files">
                                    <label>Upload Student Photo (150px X 150px)</label>
                                    <div class="uplod">
                                        <label class="file-upload image-upbtn mb-0">
                                            Choose File <input type="file">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">
                                        {#if $form.processing}
                                             <Spinner type='border' size='sm' />
                                        {/if}
                                        Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>