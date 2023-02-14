<template>
    <div class="card border-secondary mb-3" style=" margin: auto; width: fit-content;" >
    <div class="card-body">
        <h4 class="card-content">🕹️ Envie de 
            <button type="button" class="btn btn-info btn-lg">Jouer</button>
        </h4>
    </div>
</div>
{{ count }}
    <button @click="count++">Count</button>
</template>

<script>
export default {
    data() {
    return {
        count: 0
    }
    }
}
</script>