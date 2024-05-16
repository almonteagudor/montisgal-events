using montisgal_events.application.Groups;
using montisgal_events.domain.Groups;
using montisgal_events.mvc.Repositories;

namespace montisgal_events.mvc;

public static class MontisgalEventsServicesManager
{
    public static void AddMontisgalEventsDependencies(this IServiceCollection services)
    {
        services.AddRepositories();
        services.AddUseCases();
    }
    
    private static void AddRepositories(this IServiceCollection services)
    {
        services.AddScoped<IGroupRepository, GroupRepository>();
    }

    private static void AddUseCases(this IServiceCollection services)
    {
        services.AddScoped<GetGroupsUseCase>();
        services.AddScoped<CreateGroupUseCase>();
    }
}