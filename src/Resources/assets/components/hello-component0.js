//------ hello-component.js
Vue.component('hello-component', {
props: ['model','routeName','csrfToken'],
data () {
     return{
			 familly:"abyari"
		 }
 	},
  created:function(){
    console.log(this.familly)
  },
});
