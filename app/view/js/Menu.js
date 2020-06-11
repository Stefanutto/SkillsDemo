new Vue({
    el: "#VueMenu",
    data:{
        MenuJson:{},
        LinkCadUser: "/user/user",
        UserName:""
    },
    mounted(){
        axios.post(window.MyUrl + '/config/Menu.json')
        .then(response => {
            this.MenuJson = response.data.menu;
        });
        axios.post(window.MyUrl + '/user/getusername')
        .then(response => {
            this.UserName = response.data;
        });
    },
    methods: {
        MenuMin(){
            $(".horizontal-menu-2 .navbar.horizontal-layout-2 .nav-bottom").toggleClass("header-toggled");
        }
    }
})