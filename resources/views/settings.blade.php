@extends('layouts.master')

@section('title')
  Settings
@endsection

@section('content')
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="icofont icofont-settings bg-c-orenge"></i>
          <div class="d-inline">
            <h4>Settings</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">
                <i class="icofont icofont-home"></i>
              </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Settings</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="card">
      <div class="card-header">
        <h5>Update Settings</h5>
      </div>
      <div class="card-block">
        <form method="POST" action={{ route('settings-update') }}>
          @csrf
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="REGISTRATION_FEES">Registration Fees</label>
              <input type="text" name="REGISTRATION_FEES" id="REGISTRATION_FEES" class="form-control"
                value="{{ $settings->REGISTRATION_FEES }}" required>
            </div>
          </div>
          <hr />
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="FIRST_PENALTY_DAY">First Penalty (in days)</label>
              <input type="text" name="FIRST_PENALTY_DAY" id="FIRST_PENALTY_DAY" class="form-control"
                value="{{ $settings->FIRST_PENALTY_DAY }}" required>
            </div>
            <div class="col-md-6">
              <label for="FIRST_PENALTY_PER">First Penalty (in %)</label>
              <input type="text" name="FIRST_PENALTY_PER" id="FIRST_PENALTY_PER" class="form-control"
                value="{{ $settings->FIRST_PENALTY_PER }}" required>
            </div>
          </div>
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="SECOND_PENALTY_DAY">Second Penalty (in days)</label>
              <input type="text" name="SECOND_PENALTY_DAY" id="SECOND_PENALTY_DAY" class="form-control"
                value="{{ $settings->SECOND_PENALTY_DAY }}" required>
            </div>
            <div class="col-md-6">
              <label for="SECOND_PENALTY_PER">Second Penalty (in %)</label>
              <input type="text" name="SECOND_PENALTY_PER" id="SECOND_PENALTY_PER" class="form-control"
                value="{{ $settings->SECOND_PENALTY_PER }}" required>
            </div>
          </div>
          <hr />
          <div class="form-group form-row">
            <div class="col-md-6">
              <label for="OTP_EXPIRY_TIME">OTP Expiry (in minutes)</label>
              <input type="text" name="OTP_EXPIRY_TIME" id="OTP_EXPIRY_TIME" class="form-control"
                value="{{ $settings->OTP_EXPIRY_TIME }}" required>
            </div>
          </div>
          <hr />
          <div class="form-group">
            <label for="TNC">Terms &amp; Conditions</label>
            <textarea name="TNC" id="TNC" required>{{ html_entity_decode($settings->TNC) }}</textarea>
          </div>
          <hr />
          <div class="form-group">
            <button type="submit" class="btn btn-primary text-uppercase">update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('theme-script')
  <!-- ck editor -->
  <script src="{{ asset('assets/pages/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('own-script')
  <script>
    @if (session('success') === true)
      @if (session('message'))
        swal('{{ session('title') }}', '{{ session('message') }}', '{{ session('alert') }}');
      @endif
    @elseif (session('success') === false)
      @if (session('error'))
        swal('{{ session('title') }}', '{{ session('error') }}', '{{ session('alert') }}');
      @elseif (session('errors'))
        swal('{{ session('title') }}', '{{ session('errors') }}', '{{ session('alert') }}');
      @endif
    @endif

    CKEDITOR.replace('TNC', {
      // Define the toolbar: http://docs.ckeditor.com/#!/guide/dev_toolbar
      // The standard preset from CDN which we used as a base provides more features than we need.
      // Also by default it comes with a 2-line toolbar. Here we put all buttons in a single row.
      toolbar: [{
        name: 'clipboard',
        items: ['Undo', 'Redo']
      }, {
        name: 'styles',
        items: ['Styles', 'Format']
      }, {
        name: 'basicstyles',
        items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
      }, {
        name: 'paragraph',
        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
      }, {
        name: 'links',
        items: ['Link', 'Unlink']
      }, {
        name: 'insert',
        items: ['Image', 'EmbedSemantic', 'Table']
      }, {
        name: 'tools',
        items: ['Maximize']
      }, {
        name: 'editing',
        items: ['Scayt']
      }],

      // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
      // One HTTP request less will result in a faster startup time.
      // For more information check http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-customConfig
      customConfig: '',

      // Enabling extra plugins, available in the standard-all preset: http://ckeditor.com/presets-all
      extraPlugins: 'autoembed,embedsemantic,image2,uploadimage,uploadfile',
      imageUploadUrl: '/uploader/upload.php?type=Images',
      uploadUrl: '/uploader/upload.php',
      /*********************** File management support ***********************/
      // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
      // solution with file upload/management capabilities, like for example CKFinder.
      // For more information see http://docs.ckeditor.com/#!/guide/dev_ckfinder_integration

      // Uncomment and correct these lines after you setup your local CKFinder instance.
      // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
      // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      /*********************** File management support ***********************/

      // Remove the default image plugin because image2, which offers captions for images, was enabled above.
      removePlugins: 'image',

      // Make the editing area bigger than default.
      height: 461,

      // An array of stylesheets to style the WYSIWYG area.
      // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
      contentsCss: ['assets/pages/ckeditor/contents.css', 'assets/pages/ckeditor/artical.css'],

      // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
      bodyClass: 'article-editor',

      // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
      format_tags: 'p;h1;h2;h3;pre',

      // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
      removeDialogTabs: 'image:advanced;link:advanced',

      // Define the list of styles which should be available in the Styles dropdown list.
      // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
      // (and on your website so that it rendered in the same way).
      // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
      // that file, which means one HTTP request less (and a faster startup).
      // For more information see http://docs.ckeditor.com/#!/guide/dev_styles
      stylesSet: [
        /* Inline Styles */
        {
          name: 'Marker',
          element: 'span',
          attributes: {
            'class': 'marker'
          }
        }, {
          name: 'Cited Work',
          element: 'cite'
        }, {
          name: 'Inline Quotation',
          element: 'q'
        },

        /* Object Styles */
        {
          name: 'Special Container',
          element: 'div',
          styles: {
            padding: '5px 10px',
            background: '#eee',
            border: '1px solid #ccc'
          }
        }, {
          name: 'Compact table',
          element: 'table',
          attributes: {
            cellpadding: '5',
            cellspacing: '0',
            border: '1',
            bordercolor: '#ccc'
          },
          styles: {
            'border-collapse': 'collapse'
          }
        }, {
          name: 'Borderless Table',
          element: 'table',
          styles: {
            'border-style': 'hidden',
            'background-color': '#E6E6FA'
          }
        }, {
          name: 'Square Bulleted List',
          element: 'ul',
          styles: {
            'list-style-type': 'square'
          }
        },

        /* Widget Styles */
        // We use this one to style the brownie picture.
        {
          name: 'Illustration',
          type: 'widget',
          widget: 'image',
          attributes: {
            'class': 'image-illustration'
          }
        },
        // Media embed
        {
          name: '240p',
          type: 'widget',
          widget: 'embedSemantic',
          attributes: {
            'class': 'embed-240p'
          }
        }, {
          name: '360p',
          type: 'widget',
          widget: 'embedSemantic',
          attributes: {
            'class': 'embed-360p'
          }
        }, {
          name: '480p',
          type: 'widget',
          widget: 'embedSemantic',
          attributes: {
            'class': 'embed-480p'
          }
        }, {
          name: '720p',
          type: 'widget',
          widget: 'embedSemantic',
          attributes: {
            'class': 'embed-720p'
          }
        }, {
          name: '1080p',
          type: 'widget',
          widget: 'embedSemantic',
          attributes: {
            'class': 'embed-1080p'
          }
        }
      ]
    });
  </script>
@endsection
