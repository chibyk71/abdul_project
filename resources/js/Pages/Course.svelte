<script context="module">
    export {default as layout} from './Layouts/App.svelte'
</script>

<script>
    export let courses, has_more;
    import { Link } from "@inertiajs/svelte";
    import { IconPlus, IconTrash, IconPencil } from "@tabler/icons-svelte";
    import { user } from "../store";
</script>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Courses</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Courses</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by course code ...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by title ...">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by level ...">
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
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Courses</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <Link href={route('course.create')} class="btn btn-primary"><IconPlus /></Link>
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
                                    <th>CODE</th>
                                    <th>TITLE</th>
                                    <th>LEVEL</th>
                                    <th>DEPARTMENT</th>
                                    <th>LECTURER</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each courses as item}
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox"
                                                    value="something">
                                            </div>
                                        </td>
                                        <td>{item.course_code}</td>
                                        <td>
                                            <h2>
                                                <a href>{item.course_title}</a>
                                            </h2>
                                        </td>
                                        <td>{item.level}</td>
                                        <td>{item.department.department}</td>
                                        <td>{item.lecturer}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                {#if $user.isAdmin}
                                                    <Link href={route('course.destroy', item.id)} class="btn btn-sm bg-success-light me-2">
                                                        <IconTrash />
                                                    </Link>
                                                    <Link href={route('course.edit', item.id)} class="btn btn-sm bg-danger-light">
                                                        <IconPencil />
                                                    </Link>
                                                {/if}
                                            </div>
                                        </td>
                                    </tr>
                                {:else}
                                    <h3 class="text-center my-4">No More Data</h3>
                                {/each}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>