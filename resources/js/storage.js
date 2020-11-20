/**
 * Simple localStorage with Cookie Fallback
 *
 * v.1.0.1
 */
class Storage {
    constructor() {
        this.lsSupport = false

        // Check for native support
        if (this.storageAvailable('localStorage')) {
            this.lsSupport = true
        }
    }

    /**
     * Sets/updates the key
     *
     * @param  key The key or identifier for the store
     * @param  value Contents of the store
     */
    set(key, value) {
        // Convert object values to JSON
        if (typeof value === 'object') {
            value = JSON.stringify(value)
        }
        // Set the store
        if (this.lsSupport) { // Native support
            localStorage.setItem(key, value)
        } else { // Use Cookie
            this.createCookie(key, value, 30)
        }
    }

    /**
     * Gets the key value
     *
     * @param  key The key or identifier for the store
     */
    get(key) {
        let data = null
        // Get value
        if (this.lsSupport) { // Native support
            data = localStorage.getItem(key)
        } else { // Use cookie 
            data = this.readCookie(key)
        }

        // Try to parse JSON...
        try {
            data = JSON.parse(data)
        }
        catch (e) {
            data = data
        }

        return data
    }

    /**
     * Removes the key
     *
     * @param  key The key or identifier for the store
     */
    remove(key) {
        if (this.lsSupport) { // Native support
            localStorage.removeItem(key)
        } else { // Use cookie
            this.createCookie(key, '', -1)
        }
    }

    /**
     * Creates new cookie or removes cookie with negative expiration
     *
     * @param  key The key or identifier for the store
     * @param  value Contents of the store
     * @param  exp Expiration - creation defaults to 30 days
     */
    createCookie(key, value, exp) {
        var date = new Date()
        date.setTime(date.getTime() + (exp * 24 * 60 * 60 * 1000))
        var expires = "; expires=" + date.toGMTString()
        document.cookie = key + "=" + value + expires + "; path=/"
    }

    /**
     * Returns contents of cookie
     * @param  key The key or identifier for the store
     */
    readCookie(key) {
        var nameEQ = key + "="
        var ca = document.cookie.split(';')
        for (var i = 0, max = ca.length; i < max; i++) {
            var c = ca[i]
            while (c.charAt(0) === ' ') c = c.substring(1, c.length)
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length)
        }
        return null
    }

    /**
     * Checks if type is available on the browser/device
     *
     * @param type The type to check
     */
    storageAvailable(type) {
        try {
            var storage = window[type],
                x = '__storage_test__'
            storage.setItem(x, x)
            storage.removeItem(x)
            return true
        }
        catch (e) {
            return false
        }
    }
}

export default Storage
