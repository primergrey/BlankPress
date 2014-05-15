#!/bin/sh

# Exit script due to failure...

function death() {
    printf "\e[1m\e[31mProject Setup Failed.\e[m"
    echo
    exit 2
}

# Setup symlink to GreyPress folder...

{
    echo "Setting up core symlink..."
    ln -s ../GreyPress lib > /dev/null 2>&1
} || {
    printf "\e[1m\e[31mERROR:\e[m Failed to create symlink to core WordPress files (GreyPress)"
    echo
    death
}

echo "Core symlink setup successfully."

# Implement .gitignore file

{
    echo "Setting up gitignore file..."
    mv ./gitignore.pg .gitignore > /dev/null 2>&1
} || {
    printf "\e[1m\e[31mERROR:\e[m Failed to properly add gitignore file"
    echo
    death
}

echo "Core symlink setup successfully."

# Customize theme information

printf "Client name -> "
read CLIENTNAME
printf "Theme directory name (all lowercase, no spaces) -> "
read THEMENAME

{
    echo "Setting theme information..."
    perl -pi -e "s/%%CLIENT%%/$CLIENTNAME/g;" ./wp-content/themes/blankpress/style.css
} || {
    printf "\e[1m\e[31mERROR:\e[m Failed to properly set theme information."
    echo
    death
}

{
    echo "Setting theme directory..."
    mv ./wp-content/themes/blankpress ./wp-content/themes/$THEMENAME
} || {
    printf "\e[1m\e[31mERROR:\e[m Failed to properly set theme directory."
    echo
    death
}

echo "Theme setup successfully."

printf "\e[1m\e[32mSuccessfully built BlankPress!\e[m"
echo
exit