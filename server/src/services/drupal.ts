export async function drupalGet(query: string) {
  return await (await fetch(process.env.DRUPAL_API_URL + query, {
    method: "GET",
    headers: {
      'Authorization': `Basic ${btoa(process.env.DRUPAL_API_USER + ':' + process.env.DRUPAL_API_KEY)}`,
      'Accept': 'application/vnd.api+json'
    }
  })).json();
}

export async function drupalPost(query: string, data: any) {
  return await (await fetch(process.env.DRUPAL_API_URL + query, {
    method: "POST",
    headers: {
      //'Authorization': `Basic ${btoa(process.env.DRUPAL_API_USER + ':' + process.env.DRUPAL_API_KEY)}`,
      'Authorization': `Basic ${btoa(process.env.DRUPAL_API_USER + ':' + process.env.DRUPAL_API_KEY)}`,
      'Accept': 'application/vnd.api+json',
      'Content-type': 'application/vnd.api+json'
    },
    body: JSON.stringify(data)
  })).json();
}

export async function drupalPatch(query: string, data: any) {
  return await (await fetch(process.env.DRUPAL_API_URL + query, {
    method: "PATCH",
    headers: {
      'Authorization': `Basic ${btoa(process.env.DRUPAL_API_USER + ':' + process.env.DRUPAL_API_KEY)}`,
      'Accept': 'application/vnd.api+json',
      'Content-type': 'application/vnd.api+json'
    },
    body: JSON.stringify(data)
  })).json();
}
