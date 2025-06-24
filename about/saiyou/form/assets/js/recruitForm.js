class FormValidator {
  $form;

  errorMessages = {
    required: '※必須項目が入力されていません',
    common: '※入力内容が正しくありません',
  }

  constructor(form) {
    if (!form) return;

    this.$form = form;
    this.$form.noValidate = true;
    this.$form.addEventListener('submit', this.onSubmit.bind(this));

    const onChangeField = this.onChangeField.bind(this);
    this.$form.querySelectorAll('input, select, textarea').forEach(field => {
      field.addEventListener('change', onChangeField);
    });
  }

  check(field) {
    let errorMessage = '';

    field = this.getCheckTarget(field);
    if (field.type === 'checkbox' || field.type === 'radio') {
      // checkbox | radio の場合は先頭だけ調べる
      const fields = Array.from(this.$form.querySelectorAll('[name="' + field.name + '"]'));
      if (fields.indexOf(field) === 0) {
        if (!field.checkValidity()) {
          // 未入力エラー
          if (fields.some(field => field.required) && !fields.some(field => field.checked)) {
            errorMessage = this.errorMessages.required;
          }

          if (!errorMessage) {
            errorMessage = this.errorMessages.common;
          }
        }

        this.reportError(field, errorMessage);
      }
    } else {
      if (!field.checkValidity()) {
        // 未入力エラー
        if (field.required && !field.value) {
          errorMessage = this.errorMessages.required;
        }

        if (!errorMessage) {
          errorMessage = this.errorMessages.common;
        }
      }

      this.reportError(field, errorMessage);
    }

    return !errorMessage;
  }

  reportError(field, errorMessage) {
    const $error = this.getErrorElement(field);
    if ($error) {
      if (errorMessage) {
        $error.innerText = errorMessage;
      } else {
        $error.remove();
      }
    }
  }

  getErrorElement(field) {
    const $parent = field.closest('dd, .recruitForm__fieldgroup__body, .recruitForm__agreement, .recruitForm__fileList li');
    if (!$parent) {
      return;
    }

    let $error = $parent.querySelector('.recruitForm__error');
    if (!$error) {
      $error = document.createElement('p');
      $error.classList.add('recruitForm__error');
      $parent.appendChild($error);
    }

    return $error;
  }

  getCheckTarget(field) {
    if (field.type === 'checkbox' || field.type === 'radio') {
      field = this.$form.querySelector('[name="' + field.name + '"]');
    }
    return field;
  }

  onChangeField(e) {
    this.check(e.currentTarget);
  }

  onSubmit(e) {
    if (!this.$form.checkValidity()) {
      e.preventDefault();
      let firstError = null;

      const cache = {};
      this.$form.querySelectorAll('input, select, textarea').forEach(field => {
        if (!cache.hasOwnProperty(field.name)) {
          // checkboxなどは重複してチェックしないようにキャッシュ確認してスキップさせる
          cache[field.name] = true;

          if (!this.check(field) && !firstError) {
            firstError = field;
          }
        }
      });

      if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }
}

new FormValidator(document.querySelector('.recruitForm form'));

/**
 * ファイルアップロード部品の見た目制御
 */
class FileUploadUI {
  $el;
  $input;
  $clear;

  constructor(el) {
    this.$el = el;
    this.$input = this.$el.querySelector('input[type="file"]');
    this.$clear = this.$el.querySelector('.recruitForm__fileupload__clear');

    this.$input.addEventListener('change', this.onChange.bind(this));
    this.$clear.addEventListener('click', this.onClickClear.bind(this));

    this.update();
  }

  clear() {
    this.$input.value = '';
    this.update();
  }

  update() {
    if (this.$input.value) {
      this.$input.classList.remove('placeholder-shown');
    } else {
      this.$input.classList.add('placeholder-shown');
    }
  }

  onChange() {
    this.update();
  }

  onClickClear() {
    this.clear();
  }
}

document.querySelectorAll('.recruitForm__fileupload').forEach(el => new FileUploadUI(el));
