import { defineStore } from "pinia";

export const useWorkspaceMenuStore = defineStore("WorkspaceMenuStore", {
    state: () => {
        return {
            options: {

            }
        }
    }

})

export const menuItems = [
    { name: 'Dashboard', route: 'home', icon: 'home-icon' },
    { name: 'Profile', route: 'profile', icon: 'user-icon' },
    // ... additional menu items
];
