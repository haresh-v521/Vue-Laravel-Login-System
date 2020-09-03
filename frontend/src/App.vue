<template>
    <div>
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li>
                            <router-link :to="{ name: 'home' }">Home</router-link>
                        </li>
                    </ul>
                    <ul id="nav-mobile2" class="right">
                        <li v-if="!this.$store.state.isLoggedIn">
                            <router-link :to="{ name: 'login' }">Login</router-link>
                        </li>
 
                        <li v-if="!this.$store.state.isLoggedIn">
                            <router-link :to="{ name: 'register' }">Register</router-link>
                        </li>
                        <li v-if="this.$store.state.isLoggedIn">
                            <a href="#" class="" @click="logout()">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
import store from './store'
export default {
  name: 'App',
  methods: {
    logout() {
          store.commit('LogoutUser');
          this.$router.push({ name: 'login'})
          this.$toaster.success('Logout successfully...')
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
nav {
  background-color: #2c3e50 !important;
}
</style>
