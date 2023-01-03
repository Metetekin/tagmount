<!-- sidebar menu -->
<?php
$kullanici = $_SESSION["userkullanici"];

$company_id = $db->query("SELECT COMPANY_ID FROM users 
where USER_CODE='{$kullanici}'")->fetchAll(PDO::FETCH_ASSOC);
$company;
foreach ($company_id as $result) {
    foreach ($result as $key => $value) {
        $company = $value;
    }
}
$user_id = $db->query("SELECT ROLE FROM users 
where COMPANY_ID='{$company}'")->fetchAll(PDO::FETCH_ASSOC);
$user;
foreach ($user_id as $result) {
    foreach ($result as $key => $value) {
        $user = $value;
    }
}

    ?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                <li><a href=index.php><i class="fa fa-home"></i> Anasayfa</a>
                <?php if($user=='0'){ ?>
                <li><a><i class="fa fa-video-camera"></i> Video Ayarları <span class="fa fa-chevron-down"></span></a>
               
                    <ul class="nav child_menu">
                    
                      <li><a href="dizi.php">Diziler</a></li>
                      
                      
                    </ul>
                    <li><a><i class="fa fa-file"></i> Log Kayıtları <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="companylog.php">Pointer Logları</a></li>
                      <li><a href="reklamrapor.php">Reklam Raporları</a></li>
                      
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i> Kullanıcı Ayarları <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="users.php">Kullanıcılar</a></li>
                      <li><a href="addusers.php">Kullanıcı Ekle</a></li>
                      
                      
                    </ul>
                  </li>
                  </li>
                  <?php }
                  elseif($user=='1') { ?>
                   <li><a><i class="fa fa-video-camera"></i> Video Ayarları <span class="fa fa-chevron-down"></span></a>
               
               <ul class="nav child_menu">
                 <li><a href="dizi.php">Dizi Ekle</a></li>
                 
                 
               </ul>
               <li><a><i class="fa fa-file"></i> Log Kayıtları <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="companylog.php">Pointer Logları</a></li>
             
                      
                      
                    </ul>
             </li>
                    
                    
                    <?php } ?>
                  
                </ul>
               
              </div>
              

            </div>
                  </div>
            <!-- /sidebar menu -->