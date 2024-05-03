using montisgal_events.Business.UseCases.Group;

namespace montisgal_events;

public static class MontisgalEventsServicesManager
{
    public static void AddMontisgalEventsDependencies(this IServiceCollection services)
    {
        services.AddUseCases();
    }

    private static void AddUseCases(this IServiceCollection services)
    {
        services.AddScoped<AddGroupUseCase>();
        services.AddScoped<GetGroupsUseCase>();
        services.AddScoped<DeleteGroupUseCase>();
        services.AddScoped<UpdateGroupUseCase>();
        services.AddScoped<GetGroupUseCase>();
    }
}