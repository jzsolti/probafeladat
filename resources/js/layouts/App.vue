<template>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Vehicles</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item" v-if="this.$store.state.isAuthenticated">
                                <router-link to="/" class="nav-item nav-link">Dashboard</router-link>
                            </li>
                            
                            <li class="nav-item" v-if="this.$store.state.isAuthenticated">
                               <router-link to="/logout" class="nav-item nav-link">Logout</router-link>
                            </li>
    
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <router-view> </router-view>
    </div>
</template>

<script>
export default {}
</script>