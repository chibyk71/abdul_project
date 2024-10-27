<script context="module">
    export {default as layout} from '../Layouts/App.svelte'
</script>

<script>
    import { Input, Spinner } from "@sveltestrap/sveltestrap";
    import { useForm } from "@inertiajs/svelte";

    export let course = {}, edit
    const form = useForm({
        course_code: course.course_code ?? null,
        course_title: course.course_title ?? null,
        lecturer: course.lecturer ?? null,
        department: course.department ?? null,
        level: course.level ?? null,
    })

    const submit = async function () {
        $form.post( edit? route('course.update', course.id): route('course.store'), {
            onFinish: (param)=>{
                //TODO do something here
            }
        })
    }
</script>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Course</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="subjects.html">Course</a></li>
                    <li class="breadcrumb-item active">Add Coures</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action={route('course.store')} on:submit|preventDefault={submit} method="post">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Course Information</span></h5>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Course Code <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.course_code} invalid={$form.errors.course_code} feedback={$form.errors.course_code} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Course Title <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.course_title} invalid={$form.errors.course_title} feedback={$form.errors.course_title} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Department <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.department} invalid={$form.errors.department} feedback={$form.errors.department} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Lecturer <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.lecturer} invalid={$form.errors.lecturer} feedback={$form.errors.lecturer} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Level <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.level} invalid={$form.errors.level} feedback={$form.errors.level} placeholder='100,200,300,400,500' />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">
                                        {#if $form.processing}
                                             <Spinner size='sm' type='border' />
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