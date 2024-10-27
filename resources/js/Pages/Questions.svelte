<script context="module">
    export {default as layout} from './Layouts/App.svelte'
</script>
<script>
    import { FormGroup, Input, Button } from "@sveltestrap/sveltestrap";
    import CountDown from './Components/countDown.svelte';
    import { fade, slide } from 'svelte/transition';
    import { ExamStarted, examAnswers, submitAnswers } from '../store.js'

    export let questions = [];
    const total = questions.length;
    let active = 0;

    const goTo = (page)=>{
        active = page;
    }

    const next = () => {
        active = Math.min(active + 1, total - 1);
    };

    const prev = () =>{
        active = active > 0? --active: active
    }
</script>
<div class="content container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">CHM 102</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Exam</a></li>
                    <li class="breadcrumb-item active">CHM 102</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <CountDown />
            <div class="card card-table comman-shadow">
                {#if $ExamStarted}
                    {#key active}
                        <div class="card-body" in:slide={{ delay:400 }} out:fade>
                            <p class="">Question {active + 1}</p>
                            <h3 class='card-title font-bold text-lg/none'>
                                {questions[active].question}
                            </h3>
                            <div class="mt-4">
                                {#each ['a',"b",'c','d'] as item}
                                    <FormGroup>
                                        <Input type='radio' bind:group={$examAnswers[questions[active]['id']]} value={item} label={questions[active][item]} />
                                    </FormGroup>
                                {/each}
                            </div>
                        </div>
                    {/key}
                {:else}
                    <div class="card-body items-center flex justify-center">
                        <button type="button" on:click={()=> $ExamStarted = true} class="btn btn-primary !w-40 !h-40 rounded-full">START</button>
                    </div>
                {/if}
            </div>   
            {#if $ExamStarted}
                <div>
                    <ul class="pagination flex-wrap mb-4">
                        <li class="page-item">
                            <a class="page-link" href={void(0)} on:click={prev} aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        {#each Array.from({ length: questions.length }, (v, i) => i) as item}   
                            <li class="page-item" class:active={item == active}><a class="page-link" on:click={()=>goTo(item)} href={void(0)}>{item + 1}</a></li>
                        {/each}
                        <li class="page-item">
                            <a class="page-link" href={void(0)} on:click={next} aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </div>
            {/if}

            <div class="flex justify-end">
                <Button class='btn-secondary mr-3' disabled={!$ExamStarted}>Reset</Button>
                <Button class='btn-primary' on:click={()=>submitAnswers(total)} disabled={!$ExamStarted}>Submit</Button>
            </div>
        </div>
    </div>
</div>