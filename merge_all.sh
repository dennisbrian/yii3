#!/bin/bash

# List of branches in order of newest PR to oldest PR (excluding #15 which we merge first)
branches=(
    "atlas-documentation-update-16169816648324601387" # PR 14
    "atlas-documentation-enhancement-1566556316901728340" # PR 13
    "atlas/documentation-update-13517802950458296705" # PR 12
    "atlas/documentation-update-12406597321361469400" # PR 11
    "atlas/docs-update-1329767541390459862" # PR 10
    "atlas/documentation-update-8454296679011597170" # PR 9
    "atlas-documentation-7264922196064479494" # PR 8
    "atlas-documentation-3855821790305381058" # PR 7
    "atlas-docs-update-10909789154265581848" # PR 6
    "atlas-documentation-17322277272237122436" # PR 5
    "atlas-docs-update-5091388669328362392" # PR 4
    "atlas-documentation-11257886766950615732" # PR 2
)

# Start clean
git checkout main
git reset --hard origin/main

# Merge PR #15 (Newest)
echo "Merging PR #15..."
git merge origin/atlas-docs-update-18146831669059050609 -m "Merge PR #15"
if [ $? -ne 0 ]; then
    echo "Conflict in PR #15? Unexpected."
    exit 1
fi

# Iterate
for branch in "${branches[@]}"; do
    echo "Merging $branch..."
    git merge "origin/$branch" --no-edit
    
    if [ $? -ne 0 ]; then
        echo "Conflict detected in $branch. Resolving using 'ours' (keeping newer content)..."
        # For conflicting files, checkout 'ours' (what is currently in main, i.e., newer PRs)
        # We need to identify conflicting files.
        # git checkout --ours . will checkout ours for ALL files in index.
        # This is what we want for conflicts.
        
        # Get list of unmerged files
        unmerged_files=$(git diff --name-only --diff-filter=U)
        
        if [ -n "$unmerged_files" ]; then
             git checkout --ours -- .
             git add .
             git commit --no-edit
             echo "Resolved conflict for $branch."
        else
            echo "Merge failed but no unmerged files? Aborting."
            exit 1
        fi
    else
        echo "Merged $branch cleanly."
    fi
done

echo "All merges complete."
