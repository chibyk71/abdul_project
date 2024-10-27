<script context="module">
    export {default as layout} from '../Layouts/App.svelte'
</script>
<script>
    import { Input, Spinner } from "@sveltestrap/sveltestrap";
    import { useForm } from "@inertiajs/svelte";
    import { getDept } from "../../store.js";
    import axios from "axios";

    export let exam={}, edit;

    const form = useForm({
        session: exam.session??null,
        date: exam.date ?? null,
        course_id: exam.course.id ?? null,
        time: exam.time ?? null,
        duration: exam.duration ?? null,
        semester: exam.semester ?? null,
        level: exam.level ?? null,
        department_id: exam.department.id
    })

    let dept = getDept(),
    courses = [];

    const submit = async function () {
        $form.post(edit ? route('exam.update', exam.id): route('exam.store'), {
            onFinish: (param)=>{
                //TODO do something here
            }
        })
    }

    $: {
        if ($form.level && $form.department_id) {
            axios.get(route('course.fetch',{level: $form.level,department_id:$form.department_id}))
            .then(({data}) => {
                course = data;
            })
        }
    }
</script>
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Exam</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="exam.html">Exam</a></li>
                    <li class="breadcrumb-item active">Edit Exam</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action={route('exas.create')} on:submit|preventDefault={submit} method="post">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Exam Information</span></h5>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Department <span class="login-danger">*</span></label>
                                    <Input type="select" bind:value={$form.department_id} invalid={$form.errors.department_id} feedback={$form.errors.department_id}>
                                        {#each dept as item}
                                            <option value={item.id}>{item.department}</option>
                                        {/each}
                                    </Input>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Level<span class="login-danger">*</span></label>
                                    <Input type="text" bind:value={$form.level} invalid={$form.errors.level} feedback={$form.errors.level} />
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Semester<span class="login-danger">*</span></label>
                                    <Input type="text" bind:value={$form.semester} invalid={$form.errors.semester} feedback={$form.errors.semester} />
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Session<span class="login-danger">*</span></label>
                                    <Input type="text" bind:value={$form.session} invalid={$form.errors.session} feedback={$form.errors.session} />
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Start Time <span class="login-danger">*</span></label>
                                    <Input type="text" bind:value={$form.time} invalid={$form.errors.time} feedback={$form.errors.time} />
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Duration <span class="login-danger">*</span></label>
                                    <Input type="text" bind:value={$form.duration} invalid={$form.errors.duration} feedback={$form.errors.duration} />
                                </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Event Date <span class="login-danger">*</span></label>
                                    <Input type="date" bind:value={$form.date} invalid={$form.errors.date} feedback={$form.errors.date} />
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Course<span class="login-danger">*</span></label>
                                    <Input type="select" bind:value={$form.course_id} invalid={$form.errors.course_id} feedback={$form.errors.course_id}>
                                        {#each courses as item}
                                             <option value={item.id}>{item.course_code}</option>
                                        {/each}
                                    </Input>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">
                                        {#if $form.processing}
                                             <Spinner type='border' size='sm' />
                                        {/if}
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>