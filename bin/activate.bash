
if [ -z "${BASH_ARGV[0]}" ]; then

    # as a last recourse, use the present working directory
    PACKAGE_HOME=$(pwd)

else

    # get the absolute path of the executable
    SELF_PATH=$(
        cd -P -- "$(dirname -- "${BASH_ARGV[0]}")" \
        && pwd -P
    ) && SELF_PATH=$SELF_PATH/$(basename -- "${BASH_ARGV[0]}")

    # resolve symlinks
    while [ -h "$SELF_PATH" ]; do
        DIR=$(dirname -- "$SELF_PATH")
        SYM=$(readlink -- "$SELF_PATH")
        SELF_PATH=$(cd -- "$DIR" && cd -- $(dirname -- "$SYM") && pwd)/$(basename -- "$SYM")
    done

    PACKAGE_HOME=$(dirname -- "$(dirname -- "$SELF_PATH")")

fi

export PACKAGE_HOME

# which -s narwhal doesn't work (os x 10.5, kriskowal)
if [ -f "$PACKAGE_HOME"/bin/narwhal ]; then
    NARWHAL="$PACKAGE_HOME"/bin/narwhal
elif [ -f "$PACKAGE_HOME"/packages/narwhal/bin/narwhal ]; then
    NARWHAL="$PACKAGE_HOME"/packages/narwhal/bin/narwhal
else
    env narwhal -e '' >/dev/null 2>&1
    if [ "$?" -ne 127 ]; then
        NARWHAL=narwhal
    else
        echo "ERROR: narwhal is not in your PATH nor in $PACKAGE_HOME/bin." >&2
    fi
fi

if [ -f "$PACKAGE_HOME"/narwhal.conf ]; then
    source "$PACKAGE_HOME"/narwhal.conf
    export NARWHAL_DEFAULT_ENGINE
fi

if [ "$NARWHAL" ]; then
    export PATH="$("$NARWHAL" --package "$PACKAGE_HOME" --path :)"
fi

