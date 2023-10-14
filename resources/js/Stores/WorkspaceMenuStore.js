import { defineStore } from "pinia";

export const useWorkspaceMenuStore = defineStore("WorkspaceMenuStore", {
    state: () => ({
        user: null, // Assume you have a way to set this, perhaps from an API call or another store
        companiesCount: 0, // As above
        options: [
            { name: 'Dashboard', route: 'workspace.dashboard', icon: 'dashboard', active: true },
            { name: 'Registries', route: 'workspace.registries.index', icon: 'registries', active: true },
            { name: 'Admin', route: 'admin.dashboard', icon: 'admin', active: false }, // Set dynamically later
            { name: 'Workspace', route: 'workspace.selector', icon: 'workspace', active: false }, // Set dynamically later
        ]
    }),
    getters: {
        isSuperAdmin: (state) => () => state.user && state.user.id === 1,
        hasMultipleCompanies: (state) => () => state.companiesCount > 1,
    },
    actions: {
        // Define actions to set user and companiesCount if needed
        setUser(user) {
            this.user = user;
        },
        setCompaniesCount(count) {
            this.companiesCount = count;
        },
        // ... any other actions ...
        initializeOptions() {
            this.options.find(option => option.name === 'Admin').active = this.isSuperAdmin();
            this.options.find(option => option.name === 'Workspace').active = !this.isSuperAdmin() && this.hasMultipleCompanies();
        }
    }
});
