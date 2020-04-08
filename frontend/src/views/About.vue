<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 md10 lg9>
        <v-card class="elevation-3">
          <v-row>
            <v-col cols="12" md="6" class="about-img">
              <v-img class="align-end" src="/assets/images/SpeedMeal_Team.jpg" />
            </v-col>
            <v-col cols="12" md="6" class="about-text-wrapper">
              <v-card-text class="about-text">
                <p>
                  SpeedMeal is opgericht door vier jonge, gedreven studenten afkomstig uit de Brugse hogeschool Howest,
                  die zich in het eindstadium van hun opleiding toegepaste informatica bevinden.
                </p>
                <p>
                  In maart 2020 werd duidelijk dat het coronavirus onvermijdelijk veranderingen zou toebrengen aan het klassieke vraag en aanbodpatroon. Een getroffen sector is o.a. de horeca, dit leek voor de
                  studenten van SpeedMeal het ideale moment om de horeca bij te springen met een oplossing die hen kan helpen doorheen en na deze crisis.
                </p>
                <p>
                  Samen hebben Arnaud Verpoucke, Milat Omed, Arno Arzumanyan en Oksana Gorin in een recordtempo SpeedMeal opgericht, een gratis digitaal
                  bestelplatform voor de horeca om deze moeilijke coronaperiode te overbruggen.
                </p>
              </v-card-text>
            </v-col>
          </v-row>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {};
</script>

<style>
.about-text-wrapper {
  display: flex;
  justify-content: center;
  flex-direction: column;
}
.about-text {
  color: #000 !important;
  font-size: 1em;
}
.about-img {
  margin-top: -12px;
  margin-bottom: -12px;
}
.about-img > .align-end {
  height: 100%;
}
</style>