FormValidation.formValidation(
 document.getElementById('kt_form_2'),
 {
  fields: {
   date: {
    validators: {
     notEmpty: {
      message: 'Fecha requerida'
     }
    }
   },
   
  },

  plugins: {
   trigger: new FormValidation.plugins.Trigger(),
   submitButton: new FormValidation.plugins.SubmitButton(),
   bootstrap: new FormValidation.plugins.Bootstrap({
    eleInvalidClass: '',
    eleValidClass: '',
   })
  }
 }
);