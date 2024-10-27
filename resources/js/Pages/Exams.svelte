<script context="module">
    export {default as layout} from './Layouts/App.svelte'
</script>

<script>
    import { IconPencil, IconAdjustmentsAlt, IconPlus, IconWritingSign, IconChecklist, IconTrash } from "@tabler/icons-svelte";
    import {Link} from "@inertiajs/svelte";
    import { resultModal, user, Delete } from "../store.js";
    import ResultModal from "./Components/resultModal.svelte";
    export let data;

    $:console.log($resultModal);
    
</script>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Exam</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Exam</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Exam</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href={void(0)} class="btn btn-outline-primary me-2"><IconAdjustmentsAlt /></a>
                                <Link href={route('exam.create')} class="btn btn-primary"><IconPlus /></Link>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Semester</th>
                                    <th>Level</th>
                                    <th>Session</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Date</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each data.data as exam}
                                    <tr>
                                        <td>
                                            <h2>
                                               {exam.course.course_code}
                                            </h2>
                                        </td>
                                        <td>{exam.course.course_title}</td>
                                        <td>{exam.semester}</td>
                                        <td>{exam.level}</td>
                                        <td>{exam.session}</td>
                                        <td>{exam.time}</td>
                                        <td>{exam.duration}</td>
                                        <td>{exam.date}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                {#if $user.isAdmin}
                                                    <button on:click={()=> Delete(exam.id,'exam')} class="btn btn-sm bg-success-light me-2">
                                                        <IconTrash />
                                                    </button>
                                                    <Link href={route('exam.edit', exam.id)} class="btn btn-sm bg-danger-light">
                                                        <IconPencil />
                                                    </Link>
                                                {:else if exam.is_written}
                                                    <button on:click={()=> resultModal.set([exam.id])} class="btn btn-sm bg-danger-light">
                                                        <IconChecklist />
                                                    </button>
                                                {:else}
                                                    <Link href={route('question.index', {examId:exam.id})} class="btn btn-sm bg-danger-light">
                                                        <IconWritingSign />
                                                    </Link>
                                                {/if}
                                            </div>
                                        </td>
                                    </tr>
                                {:else}
                                    <h4>Unable To Retrieve ANy Exams At the Moment</h4>
                                {/each}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<svelte:component this={$resultModal.length>0?ResultModal:null } />