#!/bin/bash
set -e

# --- CONFIG ------------------------------------------------------------------
if [ -e ../.env ]; then
    . ../.env
else
    . ../.env.dev
fi

CURRENT_DIR="$PWD"
PLUGIN_DIR="$CURRENT_DIR/../www/plugins"
THEME_DIR="$CURRENT_DIR/../www/themes"

PLUGIN_REPOS=(
  "git@github.com:digilopment/wp-plugins-content-paste-analyzer.git content-paste-analyzer"
  "git@github.com:digilopment/wp-plugins-ai-headlines.git ai-headlines"
  "git@github.com:digilopment/wp-plugins-remp-connector.git remp-connector"
)

THEME_REPOS=(
  "git@github.com:digilopment/wp-theme-webisup.git webisup"
)
# -----------------------------------------------------------------------------


# --- FUNCTIONS ---------------------------------------------------------------
clone_repos() {
  local DIR=$1
  shift
  local REPOS=("$@")

  for repo in "${REPOS[@]}"; do
    set -- $repo
    URL=$1
    FOLDER=$2
    TARGET="$DIR/$FOLDER"

    if [ -d "$TARGET" ]; then
      echo "$(basename "$DIR") $FOLDER už existuje, preskakujem klonovanie."
    else
      echo "Klonujem $(basename "$DIR") $FOLDER..."
      git clone "$URL" "$TARGET"
    fi
  done
}
# -----------------------------------------------------------------------------


# --- EXECUTION ---------------------------------------------------------------
clone_repos "$PLUGIN_DIR" "${PLUGIN_REPOS[@]}"
clone_repos "$THEME_DIR" "${THEME_REPOS[@]}"
# -----------------------------------------------------------------------------
