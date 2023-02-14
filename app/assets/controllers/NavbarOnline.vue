<script setup>
    defineProps({
    });
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">         
                <img alt="Vue logo" class="logo" src="../img/logo.svg" width="32" height="32" />  Chadikwa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-link" href="/">Accueil
                    <span class="visually-hidden">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/subscription">Premium</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/contribute">Contribuer</a>
                </li>
            </ul>
            <div class="d-flex">
                    <button type="button" class="btn btn-light"><a class="nav-link" href="/login">Connexion</a>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>