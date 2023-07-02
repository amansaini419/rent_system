$(document).ready(function() {
  //console.log(fees);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  const setAlert = (response) => {
    if(response.success !== undefined){
      if(response.success){
        //swal('', response.message, 'success');
        return true;
      }
      else{
        if(response.error !== undefined){
          swal('', response.error, 'error');
        }
        else if(response.errors !== undefined){
          const errors = response.errors;
          const errorsKeys = Object.keys(errors);
          console.log(errors);
          let message = '';
          errorsKeys.forEach( (key) => {
            console.log(key, errors[key][0]);
            $('#' + key).addClass('error');
            message = message + errors[key][0] + '\n';
          });
          swal('', message, 'warning');
        }
      }
    }
    return false;
  }

  const submitApplicationData = async () => {
    console.log($('#applicationDataForm').serialize());
    let formData = $('#applicationDataForm').serializeArray();
    let type = "PUT";
    $('input').removeClass('error');
    const response = await $.ajax({
      type: type,
      url: applicationDataUrl,
      data: formData,
      dataType: 'json',
    });
    console.log('RESPONSE', response);
    return setAlert(response);
  }

  const submiAccomodationData = async () => {
    console.log($('#accomodationDataForm').serialize());
    let formData = $('#accomodationDataForm').serializeArray();
    let type = "PUT";
    const response = await $.ajax({
      type: type,
      url: accomodationDataUrl,
      data: formData,
      dataType: 'json',
    });
    console.log('RESPONSE', response);
    return setAlert(response);
  }

  const displayFile = (event, fileId) => {
    const files = event.target.files;//$(fileId)[0].files;
    //console.log('files', files);
    if(files.length > 0){
      const previewId = fileId + 'Preview';
      $(previewId).children('.displaynone').hide();
      $(previewId).children('.upload-btn').remove();
      $(fileId).removeClass('error');
      $(previewId).children('img').attr('src', '');
      $(previewId).children('a').attr('href', '');
      const loader = $(previewId).prepend('<div class="preloader4" style="margin: 82px auto;"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
      reader = new FileReader();
      reader.onload = (event) => {
        $(previewId).children('div').remove();
        $(previewId).children('img').attr('src', reader.result);
        $(previewId).children('a').attr('href', reader.result);
        $(previewId).children('.displaynone').show();
      }
      reader.readAsDataURL(files[0]);
    }
    else{
      $(fileId).addClass('error');
      swal('SELECT FILE', 'Please select the file', 'warning');
    }
  }

  $(document).on('change', '.display-file', function(e){
    //console.log(this);
    displayFile(e, '#' + this.id);
  });

  const submitDocumentData = async () => {
    let formData = new FormData();
    if(fees){
      formData.append('passportPictureFile', $('#passportPictureFile')[0].files[0]);
      formData.append('ghanaCardFile', $('#ghanaCardFile')[0].files[0]);
      formData.append('bankStatementFile', $('#bankStatementFile')[0].files[0]);
      formData.append('employmentLetterFile', $('#employmentLetterFile')[0].files[0]);
      formData.append('ghanaCard', $('#ghanaCard').val());
      formData.append('userDataId', $('#documentDataForm input[name="userDataId"]').val());
    }
    else{
      formData.append('userDataId', $('#paymentForm input[name="userDataId"]').val());
    }
    //console.log('formData', formData);
    const type = "POST";
    const response = await $.ajax({
      type: type,
      method: type,
      url: documentDataUrl,
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      dataType: 'json',
    });
    console.log('RESPONSE', response);
    return setAlert(response);
  }

  const submiLandlordData = async () => {
    console.log($('#landlordDataForm').serialize());
    const formData = $('#landlordDataForm').serializeArray();
    const type = "PUT";
    const response = await $.ajax({
      type: type,
      url: landlordDataUrl,
      data: formData,
      dataType: 'json',
    });
    console.log('RESPONSE', response);
    return setAlert(response);
  }

  let stepNext = false;
  const stepChanged = (event, currentIndex, newIndex = 0) => {
    showLoader();
    event.preventDefault();
    console.log(currentIndex, newIndex);
    console.log('stepNext', stepNext);
    // ON APPLICATION DATA NEXT
    if (currentIndex == 0 && newIndex == 1) {
      //console.log('submitApplicationData', submitApplicationData());
      if(stepNext){
        hideLoader();
        return true;
      }
      else{
        submitApplicationData().then( (response) => {
          console.log(response);
          if(response){
            stepNext = true;
            wizard.steps("next");
          }
          else{
            hideLoader();
          }
          //return response;
        });
        //hideLoader();
        return false;
      }
    }
    // ON ACCOMODATION DATA NEXT
    else if (currentIndex == 1 && newIndex == 2) {
      if(stepNext){
        hideLoader();
        return true;
      }
      else{
        submiAccomodationData().then( (response) => {
          console.log(response);
          if(response){
            /* $('#paymentForm').submit(); */
            stepNext = true;
            wizard.steps("next");
          }
          else{
            hideLoader();
          }
        });
      }
      //hideLoader();
      return false;
    }
    // ON DOCUMENTATION DATA NEXT
    else if (currentIndex == 2 && newIndex == 3) {
      if(stepNext){
        hideLoader();
        return true;
      }
      else{
        submitDocumentData().then( (response) => {
          console.log(response);
          if(response){
            stepNext = true;
            wizard.steps("next");
          }
          else{
            hideLoader();
          }
        });
      }
      //hideLoader();
      return false;
    }
    // ON LANDLORD DATA NEXT
    else if (currentIndex == 3 && newIndex == 0) {
      if(stepNext){
        hideLoader();
        return true;
      }
      else{
        submiLandlordData().then( (response) => {
          console.log(response);
          if(response){
            stepNext = true;
            swal('APPLICATION COMPLETED', 'You have successfully completed the application.', 'success');
            hideLoader();
            setTimeout(() => {
              window.location = redirectUrl;
            }, 3*1000);
          }
          else{
            hideLoader();
          }
        });
      }
      //hideLoader();
      return false;
    }
    hideLoader();
    return true;
  }

  // For registration form wizard
  const wizard = $("#registrationForm").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    //loadingTemplate: showLoader,
    //saveState: true,
    startIndex: startIndex,
    onStepChanging: stepChanged,
    onStepChanged: function (event, currentIndex, priorIndex) {
      //showLoader();
      stepNext = false;
    },
    /* onStepChanged: function (event, currentIndex, priorIndex) {
      console.log
    }, */
    onFinishing: stepChanged,
  });

  // For date picker
  $(".date-dropper").dateDropper({
    dropWidth: 200,
    dropPrimaryColor: "#1abc9c",
    dropBorder: "1px solid #1abc9c",
    format: "Y/m/d"
  });
});