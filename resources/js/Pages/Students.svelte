<script context="module">
    export {default as layout} from './Layouts/App.svelte'
</script>

<script>
    import { IconAdjustmentsAlt, IconPencil, IconPlus, IconTrash } from "@tabler/icons-svelte";
    import { Link } from "@inertiajs/svelte";
    import {  } from "../store.js";
    export let students;
</script>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                        <li class="breadcrumb-item active">All Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by ID ...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Name ...">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Phone ...">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="search-student-btn">
                    <button type="btn" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Students</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href={"#"} class="btn btn-outline-primary me-2"><IconAdjustmentsAlt /></a>
                                <Link href={route('student.create')} class="btn btn-primary"><IconPlus /></Link>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>DEPARTMENT</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>religion</th>
                                    <th>O-Level</th>
                                    <th>DOB</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each students as student}
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{student.admission_number}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                {student.l_name +" "+ student.f_name}
                                            </h2>
                                        </td>
                                        <td>{student.department.department}</td>
                                        <td>{student.email}</td>
                                        <td>{student.phone}</td>
                                        <td>{student.religion}</td>
                                        <td>{student.olevel}</td>
                                        <td>{student.dob}</td>
                                        <td class="text-end">
                                            <div class="actions ">
                                                <Link href={route('student.edit', student.id)} class="btn btn-sm bg-success-light me-2 ">
                                                    <IconPencil />
                                                </Link>
                                                <button on:click={()=>Delete(student.id, 'student')} class="btn btn-sm bg-danger-light">
                                                    <IconTrash />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                {:else}
                                    <h4>No Student Records Retrived</h4>
                                {/each}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>