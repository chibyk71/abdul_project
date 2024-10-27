import { page, } from "@inertiajs/svelte";
import axios from "axios";
import { derived, get, writable } from "svelte/store";
import Swal from "sweetalert2";

export const isSideBarMini = writable(false);

export const user = derived(page, $page => $page.props.user);

export const examAnswers = writable({});

export const ExamStarted = writable(false);

export const submitAnswers = (total) => {
    // Get the current URL
    const url = new URL(window.location.href);

    Swal.fire({
        title: "Are You Sure You Want To Submit",
        showCancelButton: true,
        confirmButtonText: "Yes",
        showLoaderOnConfirm: true,
        preConfirm: async (login) => {
            try {
                // Use URLSearchParams to get the examId parameter
                const examId = url.searchParams.get("examId");
                const response = await axios.post(route('result.store', examId), {
                    answers: get(examAnswers),
                    total,
                }, {
                    withCredentials: true,
                    withXSRFToken: true
                });

                return response;
            } catch (error) {
                Swal.showValidationMessage(` Request failed: ${error}`);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((res) => {
        console.log(res.value.data);
        
        if (res.value.status === 200) {
            Swal.fire({
                title: "Success",
                text: "Exam completed successfully!",
                icon: "success",
                toast: true
            });

            setTimeout(() => {
                let result = res.value.data;
                Swal.fire({
                    title: "Results",
                    html: ` <div class="card mb-3" style="width: 100%;">
            <div class="card-body">
                <p class="card-text">
                    <strong>Score:</strong>
                    ${result.score} <br />
                    <strong>Total Questions:</strong>
                    ${result.total} <br />
                    <strong>Correct Answers:</strong>
                    ${result.correct}
                </p>
            </div>
        </div>`,
                    icon: "success",
                });
            }, 2000);
        }
    });
}

export const getDept = async () => {
    await axios.get(route('department.index'))
        .then(({ data }) => {
            dept = data;
        })
}

export const resultModal = writable([]);

export const Delete = (id, resource) => {

    Swal.fire({
        title: "Are You Sure You Want To Delete"+ resource,
        showCancelButton: true,
        confirmButtonText: "Yes",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            try {
                // Use URLSearchParams to get the examId parameter
                const examId = url.searchParams.get("examId");
                const response = await axios.post(route(resource+'.destroy', id), {
                    withCredentials: true,
                    withXSRFToken: true
                });

                return response;
            } catch (error) {
                Swal.showValidationMessage(` Request failed: ${error}`);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((res) => {
        if (res.value.status === 200) {
            Swal.fire({
                title: "Success",
                text: resource+" Deleted successfully!",
                icon: "success",
                toast: true
            });
        }
    });
}