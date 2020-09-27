(this["webpackJsonpsellify-frontend"]=this["webpackJsonpsellify-frontend"]||[]).push([[0],{212:function(e,t,a){e.exports=a(359)},217:function(e,t,a){},359:function(e,t,a){"use strict";a.r(t);var r=a(0),n=a.n(r),i=a(9),s=a.n(i),o=(a(217),a(23)),l=a(24),c=a(26),m=a(25),u=a(393),h=a(14),d=a(184),p=a(21),g=a(194),f=a(20),E=a.n(f),b=a(44),v=Object(b.a)(),w="https://sellify-app.herokuapp.com/backend/index.php/api";function y(e){return function(t){E.a.defaults.baseURL=w,E.a.post("/user/signin",e).then((function(e){var a=e.data;console.log(a),a.success?(t({type:"AUTH_USER",user:a.user,token:a.token}),localStorage.setItem("user",JSON.stringify(a.user)),localStorage.setItem("isLogin",!0),localStorage.setItem("token",a.token),v.push("/welcome")):(alert("Incorrect Email or password!"),t({type:"AUTH_ERROR",message:a.message}))})).catch((function(e){console.log(e),t({type:"AUTH_ERROR",payload:"Server Connection Error, Try Later."})}))}}var C=function(e){Object(c.a)(a,e);var t=Object(m.a)(a);function a(){return Object(o.a)(this,a),t.apply(this,arguments)}return Object(l.a)(a,[{key:"logOut",value:function(){console.log("LOG OUT")}},{key:"render",value:function(){var e=this.props;e.children,Object(g.a)(e,["children"]);return n.a.createElement("div",{className:"app"},n.a.createElement("div",{className:"app-body"},n.a.createElement("p",null,"Hello!")))}}]),a}(r.Component);C.defaultProps={};var S=Object(p.b)(null,{signout:function(e){return function(e){E.a.defaults.baseURL=w,E.a.defaults.headers.get.Authorization="Bearer ".concat(localStorage.getItem("token")),E.a.get("/user/signout").then((function(t){var a=t.data;a?(e({type:"UNAUTH_USER"}),window.reload(!0)):e({type:"USER_ERROR",message:a.message})})).catch((function(t){console.log(t),e({type:"USER_ERROR",payload:"Server Connection Error, Try Later."})}))}}})(C),O=a(3),k=a.n(O),j=function(e){var t=function(t){Object(c.a)(r,t);var a=Object(m.a)(r);function r(){return Object(o.a)(this,r),a.apply(this,arguments)}return Object(l.a)(r,[{key:"componentWillMount",value:function(){this.props.isLogin||v.push("/first")}},{key:"componentWillUpdate",value:function(e){e.isLogin||v.push("/first")}},{key:"render",value:function(){return n.a.createElement(e,this.props)}}]),r}(r.Component);return t.contextTypes={router:k.a.object},Object(p.b)((function(e){return{isLogin:e.auth.isLogin}}))(t)},x=a(12),N=a(59),T=a(394),R=a(390),L=a(370),F=a(371),P=a(157),B=a(367),z=a(366),A=a(155),W=a(97),U=a.n(W),D=a(98),I=a.n(D),M=a(154),H=a(389),_=a(392),Z=a(391),q=a(196),$=a(362),G=a(193),J=a(387),Y=Object(G.a)({spacing:4}),K={input:{WebkitBoxShadow:"0 0 0 1000px white inset",backgroundColor:"red !important"},textField:Object(N.a)({},"& fieldset",{borderRadius:0}),signup:{marginTop:Y.spacing(10),display:"flex",flexDirection:"row",alignItems:"center",marginLeft:Y.spacing(100),width:500},paper:{marginTop:Y.spacing(30),display:"flex",flexDirection:"column",alignItems:"center"},form:{width:"85%",marginTop:Y.spacing(5),borderRadius:0},submit:{margin:Y.spacing(3,0,2)},button:{backgroundColor:"#0655FF",marginTop:Y.spacing(3)},pass:{color:"#19b4ff",marginTop:Y.spacing(5)}},Q=function(e){Object(c.a)(a,e);var t=Object(m.a)(a);function a(){var e;return Object(o.a)(this,a),(e=t.call(this)).state={email:"",password:"",showPassword:!1,emailError:!1,passError:!1,errorEmail:"",errorPass:""},e.handleChange=e.handleChange.bind(Object(x.a)(e)),e.handleClickShowPassword=e.handleClickShowPassword.bind(Object(x.a)(e)),e.handleMouseDownPassword=e.handleMouseDownPassword.bind(Object(x.a)(e)),e.emailChange=e.emailChange.bind(Object(x.a)(e)),e.signupButtonClick=e.signupButtonClick.bind(Object(x.a)(e)),e}return Object(l.a)(a,[{key:"emailChange",value:function(e){if(this.setState({email:e.target.value}),e.target.value){null!=e.target.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)?(this.setState({emailError:!1}),this.setState({errorEmail:""})):(this.setState({emailError:!0}),this.setState({errorEmail:"Invalid Email"}))}else this.setState({emailError:!0}),this.setState({errorEmail:"Field is required"})}},{key:"handleChange",value:function(e){this.setState({password:e.target.value}),e.target.value?(this.setState({passError:!1}),this.setState({errorPass:""})):(this.setState({passError:!0}),this.setState({errorPass:"Field is required"}))}},{key:"handleClickShowPassword",value:function(e){this.setState({showPassword:!this.state.showPassword})}},{key:"handleMouseDownPassword",value:function(e){e.preventDefault()}},{key:"handleFormSubmit",value:function(e){var t=new FormData;t.append("email",this.state.email),t.append("password",this.state.password),this.props.signin(t)}},{key:"signupButtonClick",value:function(){return this.props.history.push("/register/")}},{key:"render",value:function(){var e=this.props.handleSubmit,t=this.props.classes;return n.a.createElement(J.a,{component:"main",maxWidth:"xs"},n.a.createElement(H.a,null),n.a.createElement("div",{className:t.signup},n.a.createElement(q.a,{component:"h1",variant:"h5",style:{color:"gray",fontSize:"17px"}},"Don't have a Sellify account?"),n.a.createElement(M.a,{variant:"outlined",color:"primary",style:{marginLeft:30,color:"#0655FF",fontWeight:"bold",textTransform:"none"},onClick:this.signupButtonClick},"SignUp")),n.a.createElement("div",{className:t.paper},n.a.createElement(q.a,{component:"h1",variant:"h5",style:{fontSize:"27px"}},"Login To Your Account"),n.a.createElement("form",{className:t.form,onSubmit:e(this.handleFormSubmit.bind(this))},n.a.createElement("div",{className:"TextField-without-border-radius"},n.a.createElement(A.a,{error:this.state.emailError,variant:"outlined",margin:"normal",value:this.state.email,required:!0,fullWidth:!0,id:"email",label:"Email",name:"email",autoComplete:"email",style:{width:322,borderRadius:0},autoFocus:!0,size:"small",helperText:this.state.errorEmail,onChange:this.emailChange}),n.a.createElement(z.a,{variant:"outlined",size:"small",margin:"normal",error:this.state.passError,helperText:this.state.errorEmail},n.a.createElement(F.a,{htmlFor:"outlined-adornment-password"},"Password"),n.a.createElement(L.a,{id:"password",name:"password",type:this.state.showPassword?"text":"password",value:this.state.password,onChange:this.handleChange,style:{width:322,borderRadius:4},endAdornment:n.a.createElement(P.a,{position:"end"},n.a.createElement(R.a,{"aria-label":"toggle password visibility",onClick:this.handleClickShowPassword,onMouseDown:this.handleMouseDownPassword,edge:"end"},this.state.showPassword?n.a.createElement(U.a,null):n.a.createElement(I.a,null))),labelWidth:70}),n.a.createElement(B.a,{id:"my-helper-text"},this.state.errorPass))),n.a.createElement(M.a,{type:"submit",fullWidth:!0,variant:"contained",color:"primary",className:t.button,style:{width:322,borderRadius:4}},"LOGIN"),n.a.createElement(Z.a,{container:!0},n.a.createElement(Z.a,{item:!0,xs:!0},n.a.createElement(_.a,{href:"#",variant:"body2",className:t.pass},n.a.createElement("div",{className:t.pass},n.a.createElement("center",null,"  \xa0\xa0 Forgot password?"))))))))}}]),a}(r.Component);var V=Object(p.b)((function(e){return{message:e.auth.message}}),{signin:y})(Object(T.a)({form:"login"})(Object($.a)(K)(Q))),X=a(183),ee=a(369),te=a(192),ae=a.n(te),re=Object(G.a)({spacing:4}),ne={input:{WebkitBoxShadow:"0 0 0 1000px white inset",backgroundColor:"red !important"},textField:Object(N.a)({},"& fieldset",{borderRadius:0}),signup:{marginTop:re.spacing(10),display:"flex",flexDirection:"row",alignItems:"center",marginLeft:re.spacing(100),width:500},paper:{marginTop:re.spacing(30),display:"flex",flexDirection:"column",alignItems:"center"},form:{width:400,marginTop:re.spacing(5),borderRadius:0},submit:{margin:re.spacing(3,0,2)},button:{backgroundColor:"#B1B1B1",marginTop:re.spacing(3)},pass:{color:"#19b4ff",marginTop:re.spacing(5)}},ie=function(e){Object(c.a)(a,e);var t=Object(m.a)(a);function a(){var e;return Object(o.a)(this,a),(e=t.call(this)).state={firstName:"",firstHelp:"",lastHelp:"",lastName:"",firstNameError:!1,lastNameError:!1,password:"password",showPassword:!1,emailError:!1,passError:!1,errorEmail:"",errorPass:"",email:"",phone:"",describe:"",imageURL:""},e.handleChange=e.handleChange.bind(Object(x.a)(e)),e.handleClickShowPassword=e.handleClickShowPassword.bind(Object(x.a)(e)),e.handleMouseDownPassword=e.handleMouseDownPassword.bind(Object(x.a)(e)),e.emailChange=e.emailChange.bind(Object(x.a)(e)),e.firstNameChange=e.firstNameChange.bind(Object(x.a)(e)),e.lastNameChange=e.lastNameChange.bind(Object(x.a)(e)),e.handleOnChange=e.handleOnChange.bind(Object(x.a)(e)),e.describeChange=e.describeChange.bind(Object(x.a)(e)),e.loginButtonClick=e.loginButtonClick.bind(Object(x.a)(e)),e}return Object(l.a)(a,[{key:"emailChange",value:function(e){if(this.setState({email:e.target.value}),e.target.value){null!=e.target.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)?(this.setState({emailError:!1}),this.setState({errorEmail:""})):(this.setState({emailError:!0}),this.setState({errorEmail:"Invalid Email"}))}else this.setState({emailError:!0}),this.setState({errorEmail:"Field is required"})}},{key:"handleOnChange",value:function(e){this.setState({phone:e})}},{key:"describeChange",value:function(e){this.setState({describe:e.target.value})}},{key:"handleChange",value:function(e){this.setState({password:e.target.value}),e.target.value?(this.setState({passError:!1}),this.setState({errorPass:""})):(this.setState({passError:!0}),this.setState({errorPass:"At least 8 characters At least 1 capital letter At least lowercase letter,At least 1 number"}))}},{key:"firstNameChange",value:function(e){this.setState({firstName:e.target.value}),e.target.value?(this.setState({firstNameError:!1}),this.setState({firstHelp:""})):(this.setState({firstNameError:!0}),this.setState({firstHelp:"Enter your first name"}))}},{key:"lastNameChange",value:function(e){this.setState({lastName:e.target.value}),e.target.value?(this.setState({lastNameError:!1}),this.setState({lastHelp:""})):(this.setState({lastNameError:!0}),this.setState({lastHelp:"Enter your last name"}))}},{key:"handleClickShowPassword",value:function(e){this.setState({showPassword:!this.state.showPassword})}},{key:"handleMouseDownPassword",value:function(e){e.preventDefault()}},{key:"handleFormSubmit",value:function(e){var t=new FormData;t.append("file",this.uploadInput.files[0]),t.append("fileName",this.uploadInput.files[0].name),t.append("firstName",this.state.firstName),t.append("lastName",this.state.lastName),t.append("email",this.state.email),t.append("password",this.state.password),t.append("describe",this.state.describe),t.append("phone",this.state.phone),console.log(t),this.props.signup(t)}},{key:"loginButtonClick",value:function(){return this.props.history.push("/login/")}},{key:"render",value:function(){var e=this,t=this.props.handleSubmit,a=this.props.classes;return n.a.createElement(J.a,{component:"main",maxWidth:"xs"},n.a.createElement(H.a,null),n.a.createElement("div",{className:a.signup},n.a.createElement(q.a,{component:"h1",variant:"h5",style:{fontSize:"17px",color:"gray"}},"Already have a Sellify account?"),n.a.createElement(M.a,{variant:"outlined",color:"primary",style:{marginLeft:30,color:"#0655FF",fontWeight:"bold",textTransform:"none"},onClick:this.loginButtonClick},"Login")),n.a.createElement("div",{className:a.paper},n.a.createElement(q.a,{component:"h1",variant:"h5",style:{fontSize:"27px"}},"Create a Free Account"),n.a.createElement(q.a,{component:"h1",variant:"h5",style:{fontSize:"15px",marginTop:10,color:"gray"}},"Get started with 5 free credits per month. ",n.a.createElement("br",null),n.a.createElement("center",null,"No credit card is needed.")),n.a.createElement("form",{className:a.form,onSubmit:t(this.handleFormSubmit.bind(this))},n.a.createElement("div",{className:"TextField-without-border-radius"},n.a.createElement("div",null,n.a.createElement(A.a,{style:{width:"47%"},error:this.state.firstNameError,variant:"outlined",margin:"normal",value:this.state.firstName,required:!0,fullWidth:!0,id:"firstName",label:"First Name",name:"firstName",autoComplete:"first name",autoFocus:!0,size:"small",helperText:this.state.firstHelp,onChange:this.firstNameChange}),n.a.createElement(A.a,{style:{marginLeft:23,width:"47%"},error:this.state.lastNameError,variant:"outlined",margin:"normal",value:this.state.lastName,required:!0,fullWidth:!0,id:"lastName",label:"Last Name",name:"lastName",autoComplete:"last name",autoFocus:!0,size:"small",helperText:this.state.lastHelp,onChange:this.lastNameChange})),n.a.createElement(A.a,{error:this.state.emailError,variant:"outlined",margin:"normal",value:this.state.email,required:!0,fullWidth:!0,id:"email",label:"Work Email",name:"WorkEmail",autoComplete:"email",autoFocus:!0,size:"small",helperText:this.state.errorEmail,onChange:this.emailChange}),n.a.createElement(z.a,{variant:"outlined",size:"small",margin:"normal"},n.a.createElement(F.a,{id:"demo-customized-select-label"},"Which best describe you?"),n.a.createElement(ee.a,{labelId:"demo-customized-select-label",id:"demo-customized-select",style:{width:400,borderRadius:0},onChange:this.describeChange,labelWidth:200},n.a.createElement(X.a,{value:"Marketing"},"Marketing"),n.a.createElement(X.a,{value:"Sales"},"Sales"),n.a.createElement(X.a,{value:"Recruiting"},"Recruiting"),n.a.createElement(X.a,{value:"Development"},"Development"),n.a.createElement(X.a,{value:"Other"},"Other"))),n.a.createElement(z.a,{variant:"outlined",size:"small",margin:"normal"},n.a.createElement(ae.a,{variant:"outlined",size:"small",onChange:this.handleOnChange,style:{width:400,borderRadius:0},defaultCountry:"us"})),n.a.createElement(z.a,{variant:"outlined",size:"small",margin:"normal",error:this.state.passError,helperText:this.state.errorEmail},n.a.createElement(F.a,{htmlFor:"outlined-adornment-password"},"Password"),n.a.createElement(L.a,{id:"password",name:"password",type:this.state.showPassword?"text":"password",value:this.state.password,onChange:this.handleChange,style:{width:400,borderRadius:0},endAdornment:n.a.createElement(P.a,{position:"end"},n.a.createElement(R.a,{"aria-label":"toggle password visibility",onClick:this.handleClickShowPassword,onMouseDown:this.handleMouseDownPassword,edge:"end"},this.state.showPassword?n.a.createElement(U.a,null):n.a.createElement(I.a,null))),labelWidth:70}),n.a.createElement(B.a,{id:"my-helper-text"},this.state.errorPass))),n.a.createElement("div",null,n.a.createElement("input",{ref:function(t){e.uploadInput=t},type:"file"})),n.a.createElement("br",null),n.a.createElement("hr",null),n.a.createElement(M.a,{type:"submit",fullWidth:!0,variant:"contained",color:"primary",className:a.button,style:{borderRadius:0}},"CREATE ACCOUNT"),n.a.createElement(Z.a,{container:!0},n.a.createElement(Z.a,{item:!0,xs:!0},n.a.createElement(_.a,{href:"#",variant:"body2",className:a.pass},n.a.createElement("div",{className:a.pass},n.a.createElement("center",null,"  \xa0\xa0 Forgot password?"))))))))}}]),a}(r.Component);var se=Object(p.b)((function(e){return{message:e.auth.message}}),{signup:function(e){return console.log(e),function(t){E.a.defaults.baseURL=w,E.a.post("/user/signup",e).then((function(e){var a=e.data;a.success?v.push("/login"):(alert("user register fail"),t({type:"AUTH_ERROR",message:a.message}))})).catch((function(e){console.log(e),t({type:"AUTH_ERROR",payload:"Server Connection Error, Try Later."})}))}}})(Object(T.a)({form:"register"})(Object($.a)(ne)(ie))),oe=a(99),le=Object(G.a)({spacing:4}),ce=Object($.a)({root:{"&":{width:"180px",marginTop:"3px",marginBottom:"6px"},"& .MuiFormHelperText-root":{width:250},"& .MuiInputBase-input":{borderBottomColor:"none !important"},"& fieldset":{borderRadius:4},"& label":{fontSize:"14px"},"& textarea":{fontSize:"14px"},"& label.Mui-focused":{color:"#f80066"},"& .MuiInput-underline:after":{borderBottomColor:"#f80066"},"& input":{fontSize:"14px"},"& .MuiInput-underline:hover:not(.Mui-disabled):before":{borderBottom:"2px solid #f80066"},"& .MuiOutlinedInput-root":{height:"30px","&.Mui-focused fieldset":{borderColor:"#f80066"}}}})(A.a),me={title:{marginLeft:le.spacing(-100)},logo:{width:150,height:50},signup:{marginTop:le.spacing(-20),display:"flex",flexDirection:"row",alignItems:"center",marginLeft:le.spacing(100),width:500},paper:{marginTop:le.spacing(50),display:"flex",flexDirection:"column",alignItems:"center"},form:{width:"85%",marginTop:le.spacing(5),borderRadius:0},submit:{margin:le.spacing(3,0,2)},button:{backgroundColor:"#19b4ff",marginTop:le.spacing(3)}},ue=function(e){Object(c.a)(a,e);var t=Object(m.a)(a);function a(){var e;return Object(o.a)(this,a),(e=t.call(this)).state={email:"",topEmail:"",errorEmail:"",topErrorEmail:"",emailError:!0,topEmailError:!0},e.topEmailChange=e.topEmailChange.bind(Object(x.a)(e)),e.topLoginButtonClick=e.topLoginButtonClick.bind(Object(x.a)(e)),e.topSignupButtonClick=e.topSignupButtonClick.bind(Object(x.a)(e)),e.startForFreeButtonClick=e.startForFreeButtonClick.bind(Object(x.a)(e)),e.emailChange=e.emailChange.bind(Object(x.a)(e)),e}return Object(l.a)(a,[{key:"emailChange",value:function(e){if(this.setState({email:e.target.value}),e.target.value){null!=e.target.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)?(this.setState({emailError:!1}),this.setState({errorEmail:""})):(this.setState({emailError:!0}),this.setState({errorEmail:"The e-mail address is invalid."}))}else this.setState({emailError:!0}),this.setState({errorEmail:"The e-mail address entered is invalid."})}},{key:"topEmailChange",value:function(e){if(this.setState({topEmail:e.target.value}),e.target.value){null!=e.target.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)?(this.setState({topEmailError:!1}),this.setState({topErrorEmail:""})):(this.setState({topEmailError:!0}),this.setState({topErrorEmail:"The e-mail address is invalid."}))}else this.setState({topEmailError:!0}),this.setState({topErrorEmail:"The e-mail address entered is invalid."})}},{key:"topLoginButtonClick",value:function(){return this.props.history.push("/login/")}},{key:"topSignupButtonClick",value:function(){if(!this.state.topEmailError)return this.props.history.push("/login/");this.setState({topErrorEmail:"The e-mail address is invalid."})}},{key:"startForFreeButtonClick",value:function(){if(!this.state.emailError)return this.props.history.push("/register/");this.setState({errorEmail:"The e-mail address is invalid."})}},{key:"render",value:function(){this.props.handleSubmit;var e=this.props.classes;return n.a.createElement(J.a,{component:"main",maxWidth:"xs"},n.a.createElement("div",{className:e.title},n.a.createElement("h1",null,n.a.createElement(oe.a,{src:"../../../../images/logo.png",fluid:!0,className:e.logo}))),n.a.createElement(H.a,null),n.a.createElement("div",{className:e.signup},n.a.createElement("form",{className:e.form},n.a.createElement(ce,{error:this.state.topEmailError,variant:"outlined",margin:"normal",value:this.state.topEmail,fullWidth:!0,id:"topEmail",placeholder:"Enter your work email",name:"topEmail",autoComplete:"topEmail",autoFocus:!0,helperText:this.state.topErrorEmail,onChange:this.topEmailChange}),n.a.createElement(z.a,{variant:"outlined",size:"small",margin:"normal",error:this.state.topEmailError,helperText:this.state.topErrorEmail}),n.a.createElement(M.a,{style:{marginLeft:10,marginTop:3,backgroundColor:"#f80066",color:"#ffffff",fontWeight:"bold",width:80,height:30,textTransform:"none"},onClick:this.topSignupButtonClick},"Login"))),n.a.createElement("div",{className:e.paper},n.a.createElement(q.a,{component:"h1",variant:"h5",style:{fontSize:"27px",marginRight:63}},"Start for free"),n.a.createElement("form",{className:e.form},n.a.createElement(ce,{error:this.state.emailError,variant:"outlined",margin:"normal",value:this.state.email,fullWidth:!0,id:"email",placeholder:"Enter your work email",name:"email",autoComplete:"email",autoFocus:!0,helperText:this.state.errorEmail,onChange:this.emailChange}),n.a.createElement(M.a,{style:{marginLeft:10,marginTop:3,backgroundColor:"#f80066",color:"#ffffff",fontWeight:"bold",width:100,height:30,textTransform:"none"},onClick:this.startForFreeButtonClick},"SignUp"))))}}]),a}(r.Component);var he=Object(p.b)((function(e){return{message:e.auth.message}}),{signin:y})(Object(T.a)({form:"first"})(Object($.a)(me)(ue))),de=Object(G.a)({spacing:4}),pe={title:{marginLeft:de.spacing(-100)},logo:{width:150,height:50},signup:{marginTop:de.spacing(-20),display:"flex",flexDirection:"row",alignItems:"center",marginLeft:de.spacing(100),width:500},paper:{marginTop:de.spacing(50),display:"flex",flexDirection:"column",alignItems:"center"},form:{width:"85%",marginTop:de.spacing(5),borderRadius:0},submit:{margin:de.spacing(3,0,2)},button:{backgroundColor:"#19b4ff",marginTop:de.spacing(3)}},ge=function(e){Object(c.a)(a,e);var t=Object(m.a)(a);function a(){var e;return Object(o.a)(this,a),(e=t.call(this)).gotoLoginButtonClick=e.gotoLoginButtonClick.bind(Object(x.a)(e)),e}return Object(l.a)(a,[{key:"gotoLoginButtonClick",value:function(){return this.props.history.push("/login/")}},{key:"render",value:function(){var e=this.props.classes;return n.a.createElement(J.a,{component:"main",maxWidth:"xs"},n.a.createElement("div",{className:e.title},n.a.createElement("h1",null,n.a.createElement(oe.a,{src:"../../../../images/logo.png",fluid:!0,className:e.logo}))),n.a.createElement(H.a,null),n.a.createElement("div",{className:e.signup},n.a.createElement("form",{className:e.form})),n.a.createElement("div",{className:e.paper},n.a.createElement(q.a,{component:"h1",variant:"h5",style:{fontSize:"50px",marginRight:63}},"Welcome!"),n.a.createElement("form",{className:e.form},n.a.createElement(M.a,{style:{marginLeft:80,marginTop:3,backgroundColor:"#f80066",color:"#ffffff",fontWeight:"bold",width:100,height:30,textTransform:"none"},onClick:this.gotoLoginButtonClick},"Back"))))}}]),a}(r.Component);var fe=Object(p.b)((function(e){return{message:e.auth.message}}),{signin:y})(Object(T.a)({form:"first"})(Object($.a)(pe)(ge))),Ee=a(395),be=a(28),ve=Object(h.c)({form:Ee.a,auth:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=arguments.length>1?arguments[1]:void 0;switch(t.type){case"AUTH_USER":return Object(be.a)(Object(be.a)({},e),{},{user:t.user,message:"",isLogin:!0,token:t.token});case"UNAUTH_USER":return Object(be.a)(Object(be.a)({},e),{},{user:null,isLogin:!1});case"AUTH_ERROR":return Object(be.a)(Object(be.a)({},e),{},{message:t.message});default:return e}},user:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{users:[]},t=arguments.length>1?arguments[1]:void 0;switch(t.type){case"ALL_USER":return Object(be.a)(Object(be.a)({},e),{},{users:t.users});case"DELETE_USER":return Object(be.a)(Object(be.a)({},e),{},{users:[]});case"USER_ERROR":return Object(be.a)(Object(be.a)({},e),{},{message:t.message,users:[]});default:return e}}}),we=Object(h.a)(d.a)(h.d)(ve),ye=function(e){Object(c.a)(a,e);var t=Object(m.a)(a);function a(){return Object(o.a)(this,a),t.apply(this,arguments)}return Object(l.a)(a,[{key:"render",value:function(){return n.a.createElement(p.a,{store:we},n.a.createElement(u.b,{history:v},n.a.createElement(u.c,null,n.a.createElement(u.a,{exact:!0,path:"/first",name:"First Page",component:he}),n.a.createElement(u.a,{exact:!0,path:"/login",name:"Login Page",component:V}),n.a.createElement(u.a,{exact:!0,path:"/Welcome",name:"Welcome Page",component:fe}),n.a.createElement(u.a,{exact:!0,path:"/register",name:"Register Page",component:se}),n.a.createElement(u.a,{path:"/",name:"Home",component:j(S)}))))}}]),a}(r.Component);Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));s.a.render(n.a.createElement(n.a.StrictMode,null,n.a.createElement(ye,null)),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(e){e.unregister()})).catch((function(e){console.error(e.message)}))}},[[212,1,2]]]);
//# sourceMappingURL=main.add1b5c8.chunk.js.map