<template>
  <div>
    <main>
      <div class="container">
        <NavigatorComponent/>
        <router-view></router-view>
        <SidebarComponent/>
      </div>
    </main>
  </div>
</template>
<script>
    import HeaderComponent from "./components/HeaderComponent";
    import NavigatorComponent from "./components/NavigatorComponent";
    import SidebarComponent from "./components/SidebarComponent";
    export default {
        data () {
            return {
            }
        },
        components: {
            NavigatorComponent,
            SidebarComponent,
            HeaderComponent,
            
        }
    }
</script>

<style>
    
</style>