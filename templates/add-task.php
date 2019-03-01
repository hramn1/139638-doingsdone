        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="add.php" method="post" enctype="multipart/form-data">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?php if (!empty($errors['name'])){
                                                  print ("form__input--error");} ?>"
           type="text" name="name" id="name" value="" placeholder="Введите название">
            <p class="form__message"><?= $errors['name'] ?></p>

          </div>
          <div class="form__row">
            <label class="form__label" for="project">Проект</label>
            <select class="form__input form__input--select" name="project" id="project">
                      <?php foreach ($projects as $project) {  ?>
              <option value="<?=$project['id']?>"><?= strip_tags($project['name'])?></option>
                        <?php } ?>
            </select>
            <p class="form__message"><?= $errors['project']  ?></p>


          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?php if (!empty($errors['date'])){
              print ("form__input--error");} ?>" type="date" name="date" id="date" value="<?= date("j.n.Y"); ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">

                <p class="form__message"><?= $errors['date'] ?></p>
          </div>

          <div class="form__row">
            <label class="form__label" for="preview">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="preview" id="preview" value="">

              <label class="button button--transparent" for="preview">
                <span>Выберите файл</span>
              </label>
            </div>
            <p class="form__message"><?= $errors['file']  ?></p>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>

    <?php if (!empty($errors)) : ?>
        <p class="form__message">Пожалуйста, исправьте ошибки в форме</p>
<?php endif; ?>
        </form>
