<template>
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <site-side-bar />
    <!-- End of Sidebar -->
    <div class="main-content">
      <header>
        <div class="header-title">
          <h1>
            <label for="">
              <span class="las la-igloo"></span>
            </label>
            Template Upload
          </h1>
        </div>
        <div class="search-wrapper">
          <span class="las la-search"></span>
          <input
            type="search"
            class="search-wrapper"
            placeholder="Search here"
            v-model="search"
          />
        </div>
        <div class="user-wrapper">
          <img
            src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
            width="30px"
            height="30px"
            alt=""
          />
          <div>
            <h4>Shireen Imran</h4>
            <small>Super Admin</small>
          </div>
        </div>
      </header>
      <main>
        <br />
        <br />
        <br />

        <div v-if="error!=''" class="alert alert-danger" role="alert">
          {{error}}
        </div>
        <input
          type="file"
          name="file"
          ref="file"
          id="fUpload"
          style="display: none"
          v-on:change="handleFileUpload"
          accept=".json"
        />
        <button class="btn btn-primary" @click="handleButtonClick">
          Upload
        </button>
        <div class="card-body">
          <table width="100%">
            <thead>
              <tr>
                <td>Data</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td >
                  <div class="title"  v-on:click="toggle">
                    <span
                      class="toggleIcon"
                      id="toggleIcon"
                      >{{toggleIcon}}</span
                    >
                    <div id="text_min" style="display: none">
                      {{ filteredList }}
                    </div>
                  </div>
                  <div class="body" id="toggle">
                    <span id="searchcolor">
                      {{ filteredList }}
                    </span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column"></div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
</template>
<style>
#text_min {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 50ch;
}

</style>
<script>

import SiteSideBar from "./layouts/SiteSideBar.vue";
//import SiteSideNav from "./layouts/SiteSideNav.vue";

let billingAddressObj={};
let currencyObj={};
let obj={};
let translationObj={};
var dataImage;
export default {

    data() {
        return {
            error: "",
           // toggle:[]
            dataJson:[{}],
            isFile:"no",
            toggleIcon: '+',
            search: '',
            filtered: [{}],

        };
    },

    components: {
        SiteSideBar

    },
    methods:{
      handleButtonClick(){
        this.$refs.file.click();
      },
      handleFileUpload(event){
        var file = document.querySelector("#fUpload");
        if ( /\.(json)$/i.test(file.files[0].name) === false ) {
          this.error = 'Application accept json file only!';
          return this.error;
       }else{
       this.error  = "";
       let files = this.$refs.file.files
       var reader = new FileReader();
       reader.onload = onReaderLoad;
       reader.readAsText(files[0]);

        function onReaderLoad(event){
         let shopArray =[];
         let translationArray = [];
         let currencyArray    = [];
         let billingAddressArray    = [];
       
         let json = JSON.parse(event.target.result);
         console.log(json);
         let page= json.pages[0];
         var jsonArray = page.components.map(function(Json){
            return Json.value;
         });

         for (let jsonArrayKey of  jsonArray)
         {
       
          if(jsonArray[0])
         {
          
          dataImage = jsonArray[0].split('data:');
         }

          let shop=/\{shop\:\:([a-z0-9_]+)\}/g;
          let _translations=/\{translations\:\:([a-z0-9_]+)\}/g;
          let currency=/\{currency\}\ {([a-z0-9_]+)\}/g;
          let billingAddress=/\{billing_address\:\:([a-z0-9_]+)\}/g;
          let shopVar = '';
          let _translationVar = '';
          let currencyVar = '';
          let billingAddressVar = '';
          //shop
          do{
            shopVar = shop.exec(jsonArrayKey);
		         if(shopVar){
              shopArray.push(shopVar[1]);
            }
	       }while(shopVar);


         for(let shop of shopArray){
	        obj[shop]=" ";
	     }

         // translations
         do{
         _translationVar = _translations.exec(jsonArrayKey);
		         if(_translationVar){
              translationArray.push(_translationVar[1]);
            }
	       }while(_translationVar);

       for(let translation of translationArray){
         translationObj[translation]=" ";
	     }
       //currency
       do{
        currencyVar = currency.exec(jsonArrayKey);
		         if(currencyVar){
              currencyArray.push(currencyVar[1]);
            }
	       }while(currencyVar);

        for(let currency of currencyArray){
          currencyObj[currency]=" ";
	      }


         //billing
       do{
        billingAddressVar = billingAddress.exec(jsonArrayKey);
		         if(billingAddressVar){
              billingAddressArray.push(billingAddressVar[1]);
            }
	       }while(billingAddressVar);


        for(let bill of billingAddressArray){
          billingAddressObj[bill]=" ";
	      }
        }

        }
      

        setInterval(() => {
          this.dataJson =  [{
              "billing_address":billingAddressObj,
              "billing_receiver_company":"",
              "billing_receiver_fullname":"",
              "currency":currencyObj,
              "data":(dataImage)?dataImage[1]:'',
              "date":"",
              "gateway":"",
              "name":"",
              "note":"",
              "shop": obj,
              "translation":translationObj,
              "total_in_words":""

            }];
        }, 500);


       }
     },
      toggle : function() {
            var state = document.getElementById('toggle').style
            var text_min = document.getElementById('text_min').style

            if(state.display == 'none') {
                state.display = 'block'
                text_min.display = 'block'
            } else {
                state.display = 'none'
                text_min.display = 'none'
            }

            if(state.display == 'none') {
                this.toggleIcon = '+'
                text_min.display = 'block'
            } else {
                this.toggleIcon = '-'
                text_min.display = 'none'
            }
      }
    },
    created(){
     setInterval(() => {
       this.filtered=this.dataJson;
     }, 100);

    },

    computed:   {
      rdataJson() {
        setInterval(() => {

           this.dataJson = [{
              "billing_address":billingAddressObj,
              "billing_receiver_company":"",
              "billing_receiver_fullname":"",
              "currency":currencyObj,
              "data":"",
              "date":"",
              "gateway":"",
              "name":"",
              "note":"",
              "shop": obj,
              "translation":translationObj,
              "total_in_words":""

            }];

        }, 2000);


      },
      filteredList: function () {
              var filterKey = this.search && this.search.toLowerCase()
              var data = this.dataJson[0];
              var dataarray =  Object.keys(data);



          if (!filterKey) {
             return data;
            }

          return dataarray
                .filter(function(key) {

                  var row = data[key];
                  return Object.keys(row)
                  .some(function(key) {


                   if(key==filterKey){

                      var isCheck;
                      if(Object.keys(data['translation'])){
                        isCheck = String(Object.keys(data['translation'])).indexOf(key) > -1;

                      }
                      if(isCheck===false){
                        isCheck = String(Object.keys(data['currency'])).indexOf(key) > -1;

                      }
                      if(isCheck===false){
                        isCheck = String(Object.keys(data['shop'])).indexOf(key) > -1;

                      }

                      if(isCheck===false){
                        isCheck = String(Object.keys(data['billing_address'])).indexOf(key) > -1;

                      }

                      return isCheck;


                    }
                    return String(Object.keys(data)).indexOf(filterKey) > -1;

                   })
                })
                .reduce(function(acc, key) {
                 return data;
                  }, {})
            }
        }
};
</script>
