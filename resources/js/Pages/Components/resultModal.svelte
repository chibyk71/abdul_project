<script>
    import { Modal } from "@sveltestrap/sveltestrap";
    import { resultModal } from "../../store.js";
    import { onMount } from "svelte";
    import axios from "axios";
    let open = $resultModal.length > 0;
    const toggle = () => (open = !open);

    let result = {};

    onMount(() => {
        axios.get(route('result.show', $resultModal[0]))
        .then(({data})=>{
            result = data[0];
            console.log(result);
            
        })
    });

</script>

<div>
    <Modal body header={result.title} isOpen={open} {toggle}>
        <div class="card mb-3" style="width: 100%;">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Exam: {result.title}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <strong>Score:</strong>
                    {result.score} <br />
                    <strong>Total Questions:</strong>
                    {result.total} <br />
                    <strong>Correct Answers:</strong>
                    {result.correct}
                </p>
            </div>
        </div>
    </Modal>
</div>
