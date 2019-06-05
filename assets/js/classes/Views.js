if ( typeof ViewsClasses !== 'function' )
{

  var viewidentifiers = [];
  class ViewsClasses {


    addView(identifier)
    {
        viewidentifiers.push(identifier);
    }









  }

	var Views = new ViewsClasses();
}
