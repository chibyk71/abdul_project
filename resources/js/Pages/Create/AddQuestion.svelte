<script context="module">
    export {default as layout} from '../Layouts/App.svelte'
</script>

<script>
    import { Input, Spinner } from "@sveltestrap/sveltestrap";
    import { useForm } from "@inertiajs/svelte";

    export let question={}, edit;

    const form = useForm({
        question: question.question ?? null,
        a: question.a ?? null,
        b: question.b ?? null,
        c: question.c ?? null,
        d: question.d ?? null,
        answer: question.answer ?? null,
        exam_id: question.exam_id ?? null
    })

    const submit = async function () {
        $form.post(!edit? route('question.store'): route('question.update', question.id), {
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
                    <li class="breadcrumb-item"><a href="subjects.html">Questions</a></li>
                    <li class="breadcrumb-item active">Add Questions</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action={route('question.store')} on:submit|preventDefault={submit} method="post">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Questions Information</span></h5>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Course Code <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.course_code} invalid={$form.errors.course_code} feedback={$form.errors.course_code} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Question <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.question} invalid={$form.errors.question} feedback={$form.errors.question} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Option A <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.a} invalid={$form.errors.a} feedback={$form.errors.a} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Option B <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.b} invalid={$form.errors.b} feedback={$form.errors.b} />
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Option C <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.c} invalid={$form.errors.c} feedback={$form.errors.c} />
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Option D <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.d} invalid={$form.errors.d} feedback={$form.errors.d} />
                                </div>
                            </div>

                            
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Answer <span class="login-danger">*</span></label>
                                    <Input type="text" class="form-control" bind:value={$form.answer} invalid={$form.errors.answer} feedback={$form.errors.answer} />
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