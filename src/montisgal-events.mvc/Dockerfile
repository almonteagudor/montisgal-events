FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS base
USER $APP_UID
WORKDIR /app
EXPOSE 8080
EXPOSE 8081

FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
ARG BUILD_CONFIGURATION=Release
WORKDIR /src
COPY ["src/montisgal-events.mvc/montisgal-events.mvc.csproj", "src/montisgal-events.mvc/"]
RUN dotnet restore "src/montisgal-events.mvc/montisgal-events.mvc.csproj"
COPY . .
WORKDIR "/src/src/montisgal-events.mvc"
RUN dotnet build "montisgal-events.mvc.csproj" -c $BUILD_CONFIGURATION -o /app/build

FROM build AS publish
ARG BUILD_CONFIGURATION=Release
RUN dotnet publish "montisgal-events.mvc.csproj" -c $BUILD_CONFIGURATION -o /app/publish /p:UseAppHost=false

FROM base AS final
WORKDIR /app
COPY --from=publish /app/publish .
ENTRYPOINT ["dotnet", "montisgal-events.mvc.dll"]
