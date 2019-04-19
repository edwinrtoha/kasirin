
<!--add modal-->
<modal v-if="addModal" @close="clearAll()">

<h3 slot="head" >Tambah Biodata</h3>
<div slot="body" class="row">
    <div class="col-md-4">
          <div class="form-group">
    <label>nama</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nama}" name="nama" v-model="newbiodata.nama">
            
             <div class="has-text-danger" v-html="formValidate.nama"> </div>
            </div>
        </div>
        <div class="col-md-4">
             <div class="form-group">
    <label>alamat</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.alamat}" name="alamat" v-model="newbiodata.alamat">
            
             <div class="has-text-danger" v-html="formValidate.alamat"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
    <label>Nomor Hp</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nohp}" name="nohp" v-model="newbiodata.nohp">
            
             <div class="has-text-danger" v-html="formValidate.nohp"> </div>
            </div>
         </div>
     </div>

<div slot="foot">
    <button class="btn btn-dark" @click="tambah">Tambah Biodata</button>
</div>

</modal>
<!-- update -->

<modal v-if="editModal" @close="clearAll()">
<h3 slot="head" >Edit Biodata</h3>
<div slot="body" class="row">
    <div class="col-md-4">
          <div class="form-group">
       
    <label>nama</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nama}" name="nama" v-model="pilihbiodata.nama">
            
             <div class="has-text-danger" v-html="formValidate.firstname"> </div>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
       
    <label>alamat</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.alamat}" name="alamat" v-model="pilihbiodata.alamat">
            
             <div class="has-text-danger" v-html="formValidate.alamat"> </div>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
       
    <label>nomor HP</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nohp}" name="nohp" v-model="pilihbiodata.nohp">
            
             <div class="has-text-danger" v-html="formValidate.nohp"> </div>
</div>
        
     
           
   
    </div>
    
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="updatebiodata">Update</button>
</div>
</modal>


<!--delete modal-->
<modal v-if="deleteModal" @close="clearAll()">
    <h3 slot="head">Delete</h3>
    <div slot="body" class="text-center">Yakin Hapus Biodata Ini?</div>
    <div slot="foot">
        <button class="btn btn-dark" @click="deleteModal = false; deletebiodata()" >Hapus</button>
        <button class="btn" @click="deleteModal = false">Cancel</button>
    </div>
</modal>
