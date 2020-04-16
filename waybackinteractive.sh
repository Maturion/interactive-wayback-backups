
for file in $(find . -type f -name \*.php?\*)

do

    echo $file
    filename=$(basename -- "$file")
    extension="${filename##*.}"
    filename="${filename%.*}"
    mkdir -p ".phparchiv"/${filename}

    echo "${filename}-${extension}.txt"
    cp "${file}" ".phparchiv"/${filename}/"${filename}-${extension}.txt"

    #Create $filename.php if it doesn't exist

    if [ ! -f $filename ]
    then
        cp -n "_interactive_php_archive.php" "${filename}.php"
        echo ${filename}.${extension}
        rm $file
echo $file
    fi
done

