if ( typeof RFormatClasses !== 'function' )
{

  class RFormatClasses {

    getViewActionKey(dict)
    {
        var action_key = '';
        if ( typeof dict['buttons'] !== 'undefined') {
            action_key = 'buttons';
        } else if ( typeof dict['actions'] !== 'undefined' ) {
            action_key = 'actions';
        }

        return action_key;
    }



  }
  var RFormat = new RFormatClasses();
}
