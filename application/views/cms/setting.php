<h1 class="app-page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h1>
<div class="row g-4 settings-section">
   <?php if ($this->session->flashdata('alert')): ?>
      <?= $this->session->flashdata('alert'); ?>
   <?php endif ?>
   <?php $error = $this->session->flashdata('error') ?>

    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
          
          <div class="app-card-body">
             <form class="settings-form" method="post" action="<?= base_url('setting/store') ?>" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-lg-6 col-6">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label><br>
                            <?php if ($setting->logo): ?>
                              <img src="<?= base_url($setting->logo) ?>" width="50%">
                            <?php endif ?>
                            <input type="file" class="form-control" id="logo" value="<?= set_value('logo', $setting->logo) ?>" name="logo" placeholder="">
                            <?= isset($error['logo']) ? $error['logo'] : ''  ?>
                        </div>
                     </div>
                     <div class="col-lg-6 col-6">
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label><br>
                            <?php if ($setting->icon): ?>
                              <img src="<?= base_url($setting->icon) ?>" width="25%">
                            <?php endif ?>
                            <input type="file" class="form-control" id="icon" value="<?= set_value('icon', $setting->icon) ?>" name="icon" placeholder="">
                            <?= isset($error['icon']) ? $error['icon'] : ''  ?>
                        </div>
                     </div>
                  </div>

                   <div class="mb-3">
                      <label for="name" class="form-label">Nama Website</label>
                      <input type="text" class="form-control" id="name" value="<?= set_value('name', $setting->name) ?>" name="name" required placeholder="">
                      <?= isset($error['name']) ? $error['name'] : ''  ?>
                  </div>
                  <div class="mb-3">
                      <label for="about" class="form-label">Tentang Klinik</label>
                      <textarea class="form-control" id="about" name="about" required placeholder="" rows="10"><?= set_value('about', $setting->about) ?></textarea>
                      <?= isset($error['about']) ? $error['about'] : ''  ?>
                  </div>
                  <div class="row">
                     <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea class="form-control" id="visi" name="visi" required><?= set_value('visi', $setting->visi) ?></textarea>
                            <?= isset($error['visi']) ? $error['visi'] : ''  ?>
                        </div>
                     </div>
                     <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea class="form-control" id="misi" name="misi" required><?= set_value('misi', $setting->misi) ?></textarea>
                            <?= isset($error['misi']) ? $error['misi'] : ''  ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6 col-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" minlength="10" maxlength="15" id="phone" value="<?= set_value('phone', $setting->phone) ?>" name="phone" required placeholder="">
                            <?= isset($error['phone']) ? $error['phone'] : ''  ?>
                        </div>
                     </div>
                     <div class="col-lg-6 col-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= set_value('email', $setting->email) ?>" name="email" required placeholder="">
                            <?= isset($error['email']) ? $error['email'] : ''  ?>
                        </div>
                     </div>
                  </div>
                  <div class="mb-3">
                      <label for="address" class="form-label">Alamat</label>
                      <textarea class="form-control" id="address" name="address" required placeholder="" rows="10"><?= set_value('address', $setting->address) ?></textarea>
                      <?= isset($error['address']) ? $error['address'] : ''  ?>
                  </div>
                  <button type="submit" class="btn btn-primary" >Simpan</button>
                </form>
          </div><!--//app-card-body-->
          
      </div><!--//app-card-->
    </div>
</div><!--//row-->
