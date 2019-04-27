/* !author: Clavin June
   Fetch request that support method injection for laravel + jwt
*/
'use strict'
const req = {
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
  get: async function (url, headers={}) {
    try {
      return await fetch(url, {
        method: 'GET',
        headers: {...this.headers, ...headers},
      }).then(res => res.json())
    } catch (e) {
      throw Error(e)
    }
  },
  post: async function (url, data={}, headers={}) {
    try {
      return await fetch(url, {
        method: 'POST',
        headers: {...this.headers, ...headers},
        body: JSON.stringify(data)
      }).then(res => res.json())
    } catch (e) {
      throw Error(e)
    }
  },
  put: async function (url, data={}, headers={}) {
    return await this.post(url, {...data, _method: 'PUT'}, headers)
  },
  delete: async function (url, data={}, headers={}) {
    return await this.post(url, {...data, _method: 'DELETE'}, headers)
  }
}