viewtype=$1
viewname=$2
phpfile="views/"$viewtype"/"$viewname".php"
cssfile="assets/css/"$viewtype"/"$viewname".css"
jsfile="assets/js/"$viewtype"/"$viewname".js"
beforejsfile="assets/js/before/"$viewtype"/"$viewname".js"
customdirview="../custom/views/"
customdircss="../custom/css/views/"
customdirjs="../custom/js/views/"
customdirbeforejs="../custom/js/views/before/"

if [ ! -f $phpfile ]; then
    echo "PHP File not found!"
else
	cp $phpfile $customdirview
fi

if [ ! -f $cssfile ]; then
    echo "CSS File not found!"
else
	cp $cssfile $customdircss
fi

if [ ! -f $jsfile ]; then
    echo "JS File not found!"
else
	cp $jsfile $customdirjs
fi

if [ ! -f $beforejsfile ]; then
    echo "Before JS File not found!"
else
	cp $beforejsfile $customdirbeforejs
fi