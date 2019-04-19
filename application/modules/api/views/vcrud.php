<ul class="nav justify-content-center bg-dark text-light">
  <li class="nav-item">
        <a class="nav-link text-white h4" href="<?php echo site_url();?>">Crud Codeigniter + Vue + Axios</a>
  </li>
</ul>
  <div id="app">
   <div class="container">
    <div class="row">
        <transition
                enter-active-class="animated fadeInLeft"
                     leave-active-class="animated fadeOutRight">
                     <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
            </transition>
        <div class="col-md-12">
           <table class="table bg-dark my-3">
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Tambah Biodata</button></td>
                  <td><input placeholder="Cari Biodata"type="search" class="form-control" v-model="search.text" @keyup="caribiodata" name="search"></td>
               </tr>
           </table>
           <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
                
                <th class="text-white">ID</th>
                <th class="text-white">Nama</th>
                <th class="text-white">Alamat</th>
                <th class="text-white">No HP</th>
               
                <th colspan="2" class="text-center text-white">Action</th>
                </thead>
                <tbody class="table-light">
                    <tr v-for="crud in biodata" class="table-default">
                        <td>{{crud.id}}</td>
                        <td>{{crud.nama}}</td>
                        <td>{{crud.alamat}}</td>
                        <td>{{crud.nohp}}</td>
                       
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectbiodata(crud)"></button></td>
                        <td><button class="btn btn-danger fa fa-trash" @click="deleteModal = true; selectbiodata(crud)"></button></td>
                    </tr>

                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h3">Tidak ada data ditemukan</td>
                  </tr>
                </tbody>
                
            </table>
             
        </div>
  
    </div>
    <pagination
        :current_page="currentPage"
        :row_count_page="rowCountPage"
         @page-update="pageUpdate"
         :total_biodata="totalbiodata"
         :page_range="pageRange"
         >
      </pagination>
</div>
<?php include 'modal.php';?>

</div>
