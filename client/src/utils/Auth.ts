import { colyseusSDK } from "./Colyseus.js";
import { DISCORD_CLIENT_ID, discordSDK } from "./DiscordSDK.js";

export async function authenticate() {
  await discordSDK.ready();

  // Authorize with Discord Client
  const { code } = await discordSDK.commands.authorize({
    client_id: DISCORD_CLIENT_ID,
    response_type: 'code',
    state: '',
    prompt: 'none',
    // More info on scopes here: https://discord.com/developers/docs/topics/oauth2#shared-resources-oauth2-scopes
    scope: [
      // "applications.builds.upload",
      // "applications.builds.read",
      // "applications.store.update",
      // "applications.entitlements",
      // "bot",
      'identify',
      // "connections",
      // "email",
      // "gdm.join",
      'guilds',
      // "guilds.join",
      'guilds.members.read',
      // "messages.read",
      // "relationships.read",
      // 'rpc.activities.write',
      // "rpc.notifications.read",
      // "rpc.voice.write",
      'rpc.voice.read',
      // "webhook.incoming",
    ],
  });

  // Retrieve an token and userdata from your embedded app's server
  const { data } = await colyseusSDK.http.post('/discord_token', {
    headers: { 'Content-Type': 'application/json', },
    body: JSON.stringify({ code, }),
  });

  if (data.error) {
    // Throw an error
    throw new Error(data.error);
  }

  //
  // Authenticate with the token, so we can use the Discord API
  // This is required to listen to SPEAKING events
  //
  await discordSDK.commands.authenticate({ access_token: data.access_token, });

  return data;
}

export async function authenticateLocal(playerId: string) {
  try {
    console.log("Authenticating Local");
    // Attempt to authenticate with this player id
    const { data } = await colyseusSDK.http.post('/local_token', {
      headers: { 'Content-Type': 'application/json', },
      body: JSON.stringify({ playerId, }),
    });

    console.log("data", data);

    if (data.error) {
      // Throw an error
      throw new Error(data.error);
    }

    return data;
  } catch (e: any) {
    console.log("Caught authenticateLocal error", e);
  }

}
