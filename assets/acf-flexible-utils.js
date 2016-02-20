function ntzACFUtilities() {
  var $ = jQuery;

  function setSectionProperties(e) {
    var el = (e.currentTarget);

    var container = el.closest('.layout');

    var title = $('.js-acf-fc-layout-title', container);
    var type = $('.js-acf-fc-layout-type', container);
    var disable = $('.js-acf-fc-layout-disabled', container);


    var fieldTitle = $.trim($('.js-title :text', container).val());
    var fieldType = $.trim($('.js-layoutType :selected', container).text());
    var isDisabled = $('.js-disableSection :checked', container);

    title.text(fieldTitle.length ? ' - ' + fieldTitle : '');
    type.text(fieldType.length ? ' - ' + fieldType : '');
    disable.text(isDisabled.length ? ' [disabled]' : '');
  }

  function refreshSectionProperties(field) {
    $('.js-layoutType, .js-disableSection', field).trigger('change');
    $('.js-title', field).trigger('keyup');
  }

  $(document).on('change', '.js-layoutType', setSectionProperties);
  $(document).on('change', '.js-disableSection', setSectionProperties);
  $(document).on('keyup', '.js-title', setSectionProperties);

  if (typeof acf !== undefined) {
    acf.add_action('append', refreshSectionProperties);
    acf.add_action('show_field', refreshSectionProperties);
    acf.add_action('refresh', refreshSectionProperties);
  }

  refreshSectionProperties(document);
}

if (typeof acf !== undefined) {
  acf.add_action('load', ntzACFUtilities);
}